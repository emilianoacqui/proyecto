(function () {
  const container = document.getElementById('breadcrumbs');
  if (!container) return;

  const storageKey = 'site_breadcrumbs_v1';
  const currentUrl = window.location.pathname + window.location.search + window.location.hash;
  const pageTitle = (document.title && document.title.trim()) ? document.title.trim() : currentUrl;

  let breadcrumbs = [];
  try {
    breadcrumbs = JSON.parse(localStorage.getItem(storageKey) || '[]');
  } catch (e) {
    breadcrumbs = [];
  }

  // Evita duplicados consecutivos
  if (breadcrumbs.length === 0 || breadcrumbs[breadcrumbs.length - 1].url !== currentUrl) {
    breadcrumbs.push({ url: currentUrl, title: pageTitle });
    // mantener sólo últimas 10 entradas
    if (breadcrumbs.length > 10) breadcrumbs = breadcrumbs.slice(-10);
    localStorage.setItem(storageKey, JSON.stringify(breadcrumbs));
  }

  // Render
  container.innerHTML = breadcrumbs
    .map((item, idx) => {
      if (idx === breadcrumbs.length - 1) {
        return `<span class="crumb-current">${escapeHtml(item.title)}</span>`;
      }
      return `<a class="crumb-link" href="${item.url}">${escapeHtml(item.title)}</a>`;
    })
    .join(' <span class="crumb-sep">›</span> ');

  // Helpers
  function escapeHtml(str) {
    return String(str).replace(/[&<>"']/g, function (s) {
      return ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[s]);
    });
  }
})();