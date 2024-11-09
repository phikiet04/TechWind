/* Template Name: Techwind - Tailwind CSS Multipurpose Landing & Admin Dashboard Template
   Author: Shreethemes
   Email: support@shreethemes.in
   Website: https://shreethemes.in
   Version: 2.2.0
   Created: May 2022
   File Description: Main JS file of the template
*/

/*********************************/
/*         INDEX                 */
/*================================
 *     01.  Loader               *
 *     02.  Toggle Menus         *
 *     03.  Menu Active          *
 *     04.  Clickable Menu       *
 *     05.  Menu Sticky          *
 *     06.  Back to top          *
 *     07.  Active Sidebar       *
 *     08.  Feather icon         *
 *     09.  Small Menu           *
 *     10.  Wow Animation JS     *
 *     11.  Contact us           *
 *     12.  Dark & Light Mode    *
 *     13.  LTR & RTL Mode       *
 ================================*/

window.addEventListener("load", fn, false);

//  window.onload = function loader() {
function fn() {
    // Preloader
    if (document.getElementById("preloader")) {
        setTimeout(() => {
            document.getElementById("preloader").style.visibility = "hidden";
            document.getElementById("preloader").style.opacity = "0";
        }, 350);
    }
    // Menus
    activateMenu();
}

//Menu
/*********************/
/* Toggle Menu */
/*********************/
function toggleMenu() {
    document.getElementById("isToggle").classList.toggle("open");
    var isOpen = document.getElementById("navigation");
    if (isOpen.style.display === "block") {
        isOpen.style.display = "none";
    } else {
        isOpen.style.display = "block";
    }
}
/*********************/
/*    Menu Active    */
/*********************/
function getClosest(elem, selector) {
    // Element.matches() polyfill
    if (!Element.prototype.matches) {
        Element.prototype.matches =
            Element.prototype.matchesSelector ||
            Element.prototype.mozMatchesSelector ||
            Element.prototype.msMatchesSelector ||
            Element.prototype.oMatchesSelector ||
            Element.prototype.webkitMatchesSelector ||
            function (s) {
                var matches = (
                        this.document || this.ownerDocument
                    ).querySelectorAll(s),
                    i = matches.length;
                while (--i >= 0 && matches.item(i) !== this) {}
                return i > -1;
            };
    }

    // Get the closest matching element
    for (; elem && elem !== document; elem = elem.parentNode) {
        if (elem.matches(selector)) return elem;
    }
    return null;
}

function activateMenu() {
    var menuItems = document.getElementsByClassName("sub-menu-item");
    if (menuItems) {
        var matchingMenuItem = null;
        for (var idx = 0; idx < menuItems.length; idx++) {
            if (menuItems[idx].href === window.location.href) {
                matchingMenuItem = menuItems[idx];
            }
        }

        if (matchingMenuItem) {
            matchingMenuItem.classList.add("active");

            var immediateParent = getClosest(matchingMenuItem, "li");

            if (immediateParent) {
                immediateParent.classList.add("active");
            }

            var parent = getClosest(immediateParent, ".child-menu-item");
            if (parent) {
                parent.classList.add("active");
            }

            var parent = getClosest(
                parent || immediateParent,
                ".parent-menu-item"
            );

            if (parent) {
                parent.classList.add("active");

                var parentMenuitem = parent.querySelector(".menu-item");
                if (parentMenuitem) {
                    parentMenuitem.classList.add("active");
                }

                var parentOfParent = getClosest(
                    parent,
                    ".parent-parent-menu-item"
                );
                if (parentOfParent) {
                    parentOfParent.classList.add("active");
                }
            } else {
                var parentOfParent = getClosest(
                    matchingMenuItem,
                    ".parent-parent-menu-item"
                );
                if (parentOfParent) {
                    parentOfParent.classList.add("active");
                }
            }
        }
    }
}
/*********************/
/*  Clickable manu   */
/*********************/
if (document.getElementById("navigation")) {
    var elements = document
        .getElementById("navigation")
        .getElementsByTagName("a");
    for (var i = 0, len = elements.length; i < len; i++) {
        elements[i].onclick = function (elem) {
            if (elem.target.getAttribute("href") === "javascript:void(0)") {
                var submenu = elem.target.nextElementSibling.nextElementSibling;
                submenu.classList.toggle("open");
            }
        };
    }
}
/*********************/
/*   Menu Sticky     */
/*********************/
function windowScroll() {
    const navbar = document.getElementById("topnav");
    if (navbar != null) {
        if (
            document.body.scrollTop >= 50 ||
            document.documentElement.scrollTop >= 50
        ) {
            navbar.classList.add("nav-sticky");
        } else {
            navbar.classList.remove("nav-sticky");
        }
    }
}

window.addEventListener("scroll", (ev) => {
    ev.preventDefault();
    windowScroll();
});
/*********************/
/*    Back To TOp    */
/*********************/

window.onscroll = function () {
    scrollFunction();
};

function scrollFunction() {
    var mybutton = document.getElementById("back-to-top");
    if (mybutton != null) {
        if (
            document.body.scrollTop > 500 ||
            document.documentElement.scrollTop > 500
        ) {
            mybutton.classList.add("block");
            mybutton.classList.remove("hidden");
        } else {
            mybutton.classList.add("hidden");
            mybutton.classList.remove("block");
        }
    }
}

function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}

/*********************/
/*  Active Sidebar   */
/*********************/
(function () {
    var current = location.pathname.substring(
        location.pathname.lastIndexOf("/") + 1
    );
    if (current === "") return;
    var menuItems = document.querySelectorAll(".sidebar-nav a");
    for (var i = 0, len = menuItems.length; i < len; i++) {
        if (menuItems[i].getAttribute("href").indexOf(current) !== -1) {
            menuItems[i].parentElement.className += " active";
        }
    }
})();

/*********************/
/*   Feather Icons   */
/*********************/
feather.replace();

/*********************/
/*     Small Menu    */
/*********************/
try {
    var spy = new Gumshoe("#navmenu-nav a");
} catch (err) {}

/*********************/
/*      WoW Js       */
/*********************/
try {
    new WOW().init();
} catch (error) {}

/*************************/
/*      Contact Js       */
/*************************/

try {
    function validateForm() {
        var name = document.forms["myForm"]["name"].value;
        var email = document.forms["myForm"]["email"].value;
        var subject = document.forms["myForm"]["subject"].value;
        var comments = document.forms["myForm"]["comments"].value;
        document.getElementById("error-msg").style.opacity = 0;
        document.getElementById("error-msg").innerHTML = "";
        if (name == "" || name == null) {
            document.getElementById("error-msg").innerHTML =
                "<div class='alert alert-warning error_message'>*Please enter a Name*</div>";
            fadeIn();
            return false;
        }
        if (email == "" || email == null) {
            document.getElementById("error-msg").innerHTML =
                "<div class='alert alert-warning error_message'>*Please enter a Email*</div>";
            fadeIn();
            return false;
        }
        if (subject == "" || subject == null) {
            document.getElementById("error-msg").innerHTML =
                "<div class='alert alert-warning error_message'>*Please enter a Subject*</div>";
            fadeIn();
            return false;
        }
        if (comments == "" || comments == null) {
            document.getElementById("error-msg").innerHTML =
                "<div class='alert alert-warning error_message'>*Please enter a Comments*</div>";
            fadeIn();
            return false;
        }
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("simple-msg").innerHTML =
                    this.responseText;
                document.forms["myForm"]["name"].value = "";
                document.forms["myForm"]["email"].value = "";
                document.forms["myForm"]["subject"].value = "";
                document.forms["myForm"]["comments"].value = "";
            }
        };
        xhttp.open("POST", "php/contact.php", true);
        xhttp.setRequestHeader(
            "Content-type",
            "application/x-www-form-urlencoded"
        );
        xhttp.send(
            "name=" +
                name +
                "&email=" +
                email +
                "&subject=" +
                subject +
                "&comments=" +
                comments
        );
        return false;
    }

    function fadeIn() {
        var fade = document.getElementById("error-msg");
        var opacity = 0;
        var intervalID = setInterval(function () {
            if (opacity < 1) {
                opacity = opacity + 0.5;
                fade.style.opacity = opacity;
            } else {
                clearInterval(intervalID);
            }
        }, 200);
    }
} catch (error) {}

/*********************/
/* Dark & Light Mode */
/*********************/
try {
    function changeTheme(e) {
        e.preventDefault();
        const htmlTag = document.getElementsByTagName("html")[0];

        if (htmlTag.className.includes("dark")) {
            htmlTag.className = "light";
        } else {
            htmlTag.className = "dark";
        }
    }

    const switcher = document.getElementById("theme-mode");
    switcher?.addEventListener("click", changeTheme);

    const chk = document.getElementById("chk");

    chk.addEventListener("change", changeTheme);
} catch (err) {}

/*********************/
/* LTR & RTL Mode */
/*********************/
try {
    const htmlTag = document.getElementsByTagName("html")[0];
    function changeLayout(e) {
        e.preventDefault();
        const switcherRtl = document.getElementById("switchRtl");
        if (switcherRtl.innerText === "LTR") {
            htmlTag.dir = "ltr";
        } else {
            htmlTag.dir = "rtl";
        }
    }
    const switcherRtl = document.getElementById("switchRtl");
    switcherRtl?.addEventListener("click", changeLayout);
} catch (err) {}

document.addEventListener("DOMContentLoaded", function () {
    const editButton = document.getElementById("edit-address-button");
    const addressInfo = document.getElementById("address-info");
    const addressForm = document.getElementById("address-form");

    // Khi nhấn vào chỉnh sửa, ẩn thông tin và hiển thị form
    editButton.addEventListener("click", function (event) {
        event.preventDefault(); // Ngăn chặn hành động mặc định của thẻ a
        addressInfo.classList.add("hidden");
        addressForm.classList.remove("hidden");
    });
});

document
    .getElementById("avatar-upload")
    .addEventListener("change", function (event) {
        var file = event.target.files[0]; // Lấy file đầu tiên (nếu có)

        if (file) {
            var reader = new FileReader();

            // Khi file được đọc xong, cập nhật ảnh hiển thị
            reader.onload = function (e) {
                var image = document.getElementById("avatar-preview");
                image.style.display = "block"; // Hiển thị ảnh
                image.src = e.target.result; // Cập nhật đường dẫn hình ảnh
            };

            reader.readAsDataURL(file); // Đọc file như một URL hình ảnh
        }
    });
document.addEventListener("DOMContentLoaded", function () {
    // Lắng nghe sự kiện khi nhấn vào "View"
    document.querySelectorAll(".view-order-btn").forEach(function (button) {
        button.addEventListener("click", function () {
            // Lấy ID của đơn hàng
            const orderId = button.getAttribute("data-order-id");

            // In ra ID đơn hàng khi người dùng nhấn "View"
            console.log("Button clicked for order ID:", orderId);

            // Gửi yêu cầu AJAX để lấy thông tin chi tiết đơn hàng
            fetch(`/orders/${orderId}`)
                .then((response) => {
                    console.log("Response received:", response); // Log phản hồi từ server
                    return response.json();
                })
                .then((data) => {
                    console.log("Data received:", data); // Log dữ liệu nhận được từ server

                    if (data.success) {
                        const order = data.order;

                        // Kiểm tra cấu trúc dữ liệu của đơn hàng
                        console.log("Order details:", order); // Log thông tin chi tiết đơn hàng

                        // Kiểm tra danh sách items trong đơn hàng
                        console.log("Order items:", order.items); // Log danh sách sản phẩm trong đơn hàng

                        // Cập nhật thông tin modal
                        document.getElementById(
                            "order-modal-title"
                        ).innerText = `Order #${order.code}`;
                        document.getElementById("order-details").innerHTML = `
                <div><strong>Name:</strong> ${order.name || "N/A"}</div>
                <div><strong>Email:</strong> ${order.email || "N/A"}</div>
                <div><strong>Phone:</strong> ${order.phone || "N/A"}</div>
                <div><strong>Address:</strong> ${order.address || "N/A"}</div>
                <h4 class="text-sm mt-2">Status: ${order.status || "N/A"}</h4>
                <h5>Items:</h5>
                <table class="w-full text-start text-slate-500 dark:text-slate-400">
                    <thead class="text-sm uppercase bg-slate-50 dark:bg-slate-800">
                        <tr>
                            <th class="px-4 py-2 text-start">Product</th>
                            <th class="px-4 py-2 text-start">Color</th>
                            <th class="px-4 py-2 text-start">Size</th>
                            <th class="px-4 py-2 text-start">Quantity</th>
                            <th class="px-4 py-2 text-start">Price</th>
                            <th class="px-4 py-2 text-start">Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${order.items
                            .map((item) => {
                                // Kiểm tra chi tiết của mỗi item
                                console.log("Item details:", item); // Log thông tin chi tiết sản phẩm

                                return `
                                    <tr class="bg-white dark:bg-slate-900">
                                        <td class="px-4 py-2 text-start">${
                                            item.product_name || "N/A"
                                        }</td>
                                        <td class="px-4 py-2 text-start">${
                                            item.color || "N/A"
                                        }</td>
                                        <td class="px-4 py-2 text-start">${
                                            item.size || "N/A"
                                        }</td>
                                        <td class="px-4 py-2 text-start">${
                                            item.quantity || "N/A"
                                        }</td>
                                        <td class="px-4 py-2 text-start">$${
                                            item.price || "0.00"
                                        }</td>
                                        <td class="px-4 py-2 text-start">$${
                                            item.total_price || "0.00"
                                        }</td>
                                    </tr>
                                `;
                            })
                            .join("")}
                    </tbody>
                </table>
            `;
                        document
                            .getElementById("order-modal")
                            .classList.remove("hidden");
                    } else {
                        alert("Unable to fetch order details");
                    }
                })
                .catch((error) => {
                    console.error("Error:", error); // Log lỗi khi có sự cố với fetch
                    alert(
                        "There was an error fetching the order details. Please try again."
                    );
                });
        });
    });

    // Đóng modal khi nhấn "Close"
    document
        .getElementById("close-modal")
        .addEventListener("click", function () {
            document.getElementById("order-modal").classList.add("hidden");
        });
});
