
let skillesOur = document.querySelector(".skills");


window.onscroll = function () {
    let skillesOfsetTop = skillesOur.offsetTop;

    let skillesOuterHieght = skillesOur.offsetHeight;

    let windowHeight = this.innerHeight;

    let windowScrollTop = this.pageYOffset;

    if (skillesOfsetTop > (skillesOuterHieght + windowHeight - windowScrollTop)) {

        let allSkilles = document.querySelectorAll(".skill-box .skill-progres span");

        allSkilles.forEach(ele => {
            ele.style.width = ele.dataset.progress

        });
    };
};
