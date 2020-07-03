function docReady(fn) {
  if (document.readyState !== 'loading') {
    fn();
  }
  document.addEventListener('DOMContentLoaded', fn);
}