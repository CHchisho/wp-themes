(() => {
  const qs = (sel, root = document) => root.querySelector(sel);

  // Contact form AJAX
  const form = qs('[data-contact-form]');
  if (form) {
    form.addEventListener('submit', async (e) => {
      e.preventDefault();
      const statusEl = qs('[data-contact-status]', form) || qs('[data-contact-status]');
      const submitBtn = qs('button[type="submit"]', form);

      const fd = new FormData(form);
      fd.append('action', 'example_theme_submit_contact');
      fd.append('nonce', (window.ExampleTheme && window.ExampleTheme.nonce) || '');

      if (submitBtn) submitBtn.disabled = true;
      if (statusEl) {
        statusEl.textContent = 'Sending...';
        statusEl.className = 'alert alert-info mt-3';
      }

      try {
        const res = await fetch((window.ExampleTheme && window.ExampleTheme.ajaxUrl) || '/wp-admin/admin-ajax.php', {
          method: 'POST',
          credentials: 'same-origin',
          body: fd,
        });
        const json = await res.json();
        if (json && json.success) {
          form.reset();
          if (statusEl) {
            statusEl.textContent = (json.data && json.data.message) || 'Done.';
            statusEl.className = 'alert alert-success mt-3';
          }
        } else {
          const msg = (json && json.data && json.data.message) ? json.data.message : 'Error. Please check the fields.';
          if (statusEl) {
            statusEl.textContent = msg;
            statusEl.className = 'alert alert-danger mt-3';
          }
        }
      } catch (err) {
        if (statusEl) {
          statusEl.textContent = 'Network error. Please try again.';
          statusEl.className = 'alert alert-danger mt-3';
        }
      } finally {
        if (submitBtn) submitBtn.disabled = false;
      }
    });
  }

  // Like button AJAX (from like-button plugin)
  document.addEventListener('click', async (e) => {
    const btn = e.target && e.target.closest ? e.target.closest('[data-lb-like-btn]') : null;
    if (!btn) return;
    const wrap = btn.closest('[data-lb-like-wrap]');
    if (!wrap) return;

    e.preventDefault();

    const postId = wrap.getAttribute('data-post-id');
    const nonce = wrap.getAttribute('data-nonce');
    const liked = wrap.getAttribute('data-liked') === '1';

    btn.disabled = true;
    try {
      const fd = new FormData();
      fd.append('action', liked ? 'lb_ajax_remove_like' : 'lb_ajax_add_like');
      fd.append('post_id', postId || '');
      fd.append('nonce', nonce || '');

      const res = await fetch((window.ExampleTheme && window.ExampleTheme.ajaxUrl) || '/wp-admin/admin-ajax.php', {
        method: 'POST',
        credentials: 'same-origin',
        body: fd,
      });
      const json = await res.json();
      if (!json || !json.success) return;

      const countEl = wrap.querySelector('[data-lb-like-count]');
      const newCount = json.data && typeof json.data.count !== 'undefined' ? String(json.data.count) : null;
      const newLiked = !!(json.data && json.data.liked);

      wrap.setAttribute('data-liked', newLiked ? '1' : '0');
      btn.textContent = newLiked ? 'Unlike' : 'Like';
      btn.classList.toggle('btn-outline-dark', !newLiked);
      btn.classList.toggle('btn-dark', newLiked);
      if (countEl && newCount !== null) countEl.textContent = newCount;
    } finally {
      btn.disabled = false;
    }
  });
})();

