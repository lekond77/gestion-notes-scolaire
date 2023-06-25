var pages = {
  "/": "/style.css",
  "/about": "/about.css",
  "/contact": "/contact.css",
  
};

var currentPage = window.location.pathname;

for (var page in pages) {
  if (currentPage === page) {
    var link = document.createElement("link");
    link.rel = "stylesheet";
    link.type = "text/css";
    link.href = pages[page];
    document.head.appendChild(link);
  }
}

if (window.location.pathname === "/about") {
  var link = document.createElement("link");
  link.rel = "stylesheet";
  link.type = "text/css";
  link.href = "/about.css";
  document.head.appendChild(link);
}
