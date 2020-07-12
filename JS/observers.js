

function name(params) {
  const header = document.querySelector("header");
  const sectionOne = document.querySelector(".nav-trigger");

  const sectionOneOptions = {
    rootMargin: "-30px 0px 0px 0px"
  };

  const sectionOneObserver = new IntersectionObserver(function (
    entries,
    sectionOneObserver
  ) {
    entries.forEach(entry => {
      if (!entry.isIntersecting) {
        header.classList.add(params);
        document.getElementById("logo_site").src = "./assets/Images/logo.png";
      } else {
        header.classList.remove(params);
        document.getElementById("logo_site").src = "./assets/Images/WhiteLogo.png";
      }
    });
  },
    sectionOneOptions);

  sectionOneObserver.observe(sectionOne);
}
