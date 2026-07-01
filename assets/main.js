/**
 * UI 挙動（モック sikumys-final-draft.html より移植・多ページ用に調整）。
 * - スクロールでヘッダー .scrolled（縮小）
 * - トップのヒーロー内部のパララックス／フェード
 * - ハンバーガーでドロワー開閉（リンク押下 / Esc で閉じる）
 */
(function () {
  function ready(fn) {
    if (document.readyState !== 'loading') { fn(); } else { document.addEventListener('DOMContentLoaded', fn); }
  }

  ready(function () {
    var hdr = document.getElementById('hdr');
    var heroInner = document.getElementById('heroInner');
    var burger = document.getElementById('burger');
    var drawer = document.getElementById('drawer');

    function onScroll() {
      if (hdr) {
        hdr.classList.toggle('scrolled', window.scrollY > 40);
      }
      if (heroInner) {
        var y = window.scrollY;
        if (y <= 0) {
          heroInner.style.transform = '';
          heroInner.style.opacity = '';
        } else {
          var p = Math.min(1, y / Math.max(1, innerHeight));
          heroInner.style.transform = 'translateY(' + (y * 0.26) + 'px)';
          heroInner.style.opacity = String(Math.max(0, 1 - Math.max(0, p - 0.32) * 2.4));
        }
      }
    }
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();

    if (burger && drawer) {
      burger.addEventListener('click', function () {
        drawer.classList.toggle('open');
      });
      Array.prototype.forEach.call(drawer.querySelectorAll('a'), function (a) {
        a.addEventListener('click', function () { drawer.classList.remove('open'); });
      });
      document.addEventListener('keyup', function (e) {
        if (e.key === 'Escape') { drawer.classList.remove('open'); }
      });
    }
  });
})();
