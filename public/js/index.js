const sideLinks = document.querySelectorAll('.sidebar .side-menu li a:not(.logout)');

sideLinks.forEach(item => {
    const li = item.parentElement;
    const currentURL = window.location.href;
    // So sánh địa chỉ URL của thẻ liên kết với địa chỉ URL của trang hiện tại
    if (item.href === currentURL) {
        // Nếu trùng khớp, thêm class active cho thẻ li cha
        li.classList.add('active');
    } else {
        // Nếu không trùng khớp, xóa class active khỏi thẻ li cha
        li.classList.remove('active');
    }

    // Thêm sự kiện click cho thẻ liên kết
    item.addEventListener('click', () => {
        // Xóa class active khỏi tất cả các thẻ li cha
        sideLinks.forEach(i => {
            i.parentElement.classList.remove('active');
        })
        // Thêm class active cho thẻ li cha của thẻ liên kết được click
        li.classList.add('active');
    })
});

const menuBar = document.querySelector('.content nav .bx.bx-menu');
const sideBar = document.querySelector('.sidebar');

menuBar.addEventListener('click', () => {
    sideBar.classList.toggle('close');
});

const searchBtn = document.querySelector('.content nav form .form-input button');
const searchBtnIcon = document.querySelector('.content nav form .form-input button .bx');
const searchForm = document.querySelector('.content nav form');

searchBtn.addEventListener('click', function (e) {
    if (window.innerWidth < 576) {
        e.preventDefault;
        searchForm.classList.toggle('show');
        if (searchForm.classList.contains('show')) {
            searchBtnIcon.classList.replace('bx-search', 'bx-x');
        } else {
            searchBtnIcon.classList.replace('bx-x', 'bx-search');
        }
    }
});

window.addEventListener('resize', () => {
    if (window.innerWidth < 768) {
        sideBar.classList.add('close');
    } else {
        sideBar.classList.remove('close');
    }
    if (window.innerWidth > 576) {
        searchBtnIcon.classList.replace('bx-x', 'bx-search');
        searchForm.classList.remove('show');
    }
});

const toggler = document.getElementById('theme-toggle');

toggler.addEventListener('change', function () {
    if (this.checked) {
        document.body.classList.add('dark');
    } else {
        document.body.classList.remove('dark');
    }
});