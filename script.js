(() => {
  const toggle = document.getElementById("langToggle");
  const year = document.getElementById("year");
  let lang = "hu";
  year.textContent = new Date().getFullYear();

  function setLanguage(next) {
    lang = next;
    document.documentElement.lang = lang;
    document.querySelectorAll("[data-hu][data-de]").forEach((node) => {
      const value = node.dataset[lang];
      if (value !== undefined) node.innerHTML = value;
    });
    toggle.innerHTML = lang === "hu" ? 'DE <span>↗</span>' : 'HU <span>↗</span>';
    toggle.setAttribute("aria-label", lang === "hu" ? "Auf Deutsch wechseln" : "Magyar nyelvre váltás");
    document.title = lang === "hu"
      ? "VASVIN | Ipari hegesztés és kopásálló megoldások"
      : "VASVIN | Industrieschweißen und Verschleißschutz";
  }
  toggle.addEventListener("click", () => setLanguage(lang === "hu" ? "de" : "hu"));
})();