!(function () {
  "use strict";
  if (window.sessionStorage) {
    var t = sessionStorage.getItem("is_visited");
    if (t)
      switch (t) {
        case "light-mode-switch":
          document.documentElement.removeAttribute("dir"),
            "/duan1/assets/theme/admin/css/bootstrap.min.css" !=
              document.getElementById("bootstrap-style").getAttribute("href") &&
              document
                .getElementById("bootstrap-style")
                .setAttribute(
                  "href",
                  "/duan1/assets/theme/admin/css/bootstrap.min.css"
                ),
            "/duan1/assets/theme/admin/css/app.min.css" !=
              document.getElementById("app-style").getAttribute("href") &&
              document
                .getElementById("app-style")
                .setAttribute("href", "/duan1/assets/theme/admin/css/app.min.css"),
            document.documentElement.setAttribute("data-bs-theme", "light");
          break;
        case "dark-mode-switch":
          document.documentElement.removeAttribute("dir"),
            "./assets/theme/admin/css/bootstrap.min.css" !=
              document.getElementById("bootstrap-style").getAttribute("href") &&
              document
                .getElementById("bootstrap-style")
                .setAttribute(
                  "href",
                  "./assets/theme/admin/css/bootstrap.min.css"
                ),
            "./assets/theme/admin/css/app.min.css" !=
              document.getElementById("app-style").getAttribute("href") &&
              document
                .getElementById("app-style")
                .setAttribute("href", "./assets/theme/admin/css/app.min.css"),
            document.documentElement.setAttribute("data-bs-theme", "dark");
          break;
        case "rtl-mode-switch":
          "./assets/theme/admin/css/bootstrap-rtl.min.css" !=
            document.getElementById("bootstrap-style").getAttribute("href") &&
            document
              .getElementById("bootstrap-style")
              .setAttribute(
                "href",
                "./assets/theme/admin/css/bootstrap-rtl.min.css"
              ),
            "./assets/theme/admin/css/app-rtl.min.css" !=
              document.getElementById("app-style").getAttribute("href") &&
              document
                .getElementById("app-style")
                .setAttribute(
                  "href",
                  "./assets/theme/admin/css/app-rtl.min.css"
                ),
            document.documentElement.setAttribute("dir", "rtl"),
            document.documentElement.setAttribute("data-bs-theme", "light");
          break;
        case "dark-rtl-mode-switch":
          "./assets/theme/admin/css/bootstrap-rtl.min.css" !=
            document.getElementById("bootstrap-style").getAttribute("href") &&
            document
              .getElementById("bootstrap-style")
              .setAttribute(
                "href",
                "./assets/theme/admin/css/bootstrap-rtl.min.css"
              ),
            "./assets/theme/admin/css/app-rtl.min.css" !=
              document.getElementById("app-style").getAttribute("href") &&
              document
                .getElementById("app-style")
                .setAttribute(
                  "href",
                  "./assets/theme/admin/css/app-rtl.min.css"
                ),
            document.documentElement.setAttribute("dir", "rtl"),
            document.documentElement.setAttribute("data-bs-theme", "dark");
          break;
        default:
          console.log("Something wrong with the layout mode.");
      }
  }
})(window.jQuery);
