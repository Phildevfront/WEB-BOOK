const navbar = document.querySelector('.nav-fixed');
window.onscroll = () => {
    if (window.scrollY > 700) {
        navbar.classList.add('nav-active');
    } else {
        navbar.classList.remove('nav-active');
    }
};



