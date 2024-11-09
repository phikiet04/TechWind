<!-- Footer Start -->
<footer class="footer bg-dark-footer relative text-gray-200 dark:text-gray-200">
    <div class="container relative">
        <div class="grid grid-cols-12">
            <div class="col-span-12">
                <div class="py-[60px] px-0">
                    <div class="grid md:grid-cols-12 grid-cols-1 gap-[30px]">
                        <div class="lg:col-span-3 md:col-span-12">
                            <a href="#" class="text-[22px] focus:outline-none">
                                <img src="assets/images/logo-light.png" alt="" />
                            </a>
                            <p class="mt-6 text-gray-300">
                                TendWind Shop - Nơi cung cấp các sản phẩm công nghệ tiên tiến, giúp bạn trải nghiệm sự
                                đổi mới trong từng sản phẩm.

                            </p>
                            <ul class="list-none mt-6">
                                <li class="inline">
                                    <a href="https://1.envato.market/techwind" target="_blank"
                                        class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center border-gray-800 rounded-md border hover:border-indigo-600 dark:hover:border-indigo-600 hover:bg-indigo-600 dark:hover:bg-indigo-600"><i
                                            class="uil uil-shopping-cart align-middle" title="Buy Now"></i></a>
                                </li>
                                <li class="inline">
                                    <a href="https://dribbble.com/shreethemes" target="_blank"
                                        class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center border-gray-800 rounded-md border hover:border-indigo-600 dark:hover:border-indigo-600 hover:bg-indigo-600 dark:hover:bg-indigo-600"><i
                                            class="uil uil-dribbble align-middle" title="dribbble"></i></a>
                                </li>
                                <li class="inline">
                                    <a href="https://www.behance.net/shreethemes" target="_blank"
                                        class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center border-gray-800 rounded-md border hover:border-indigo-600 dark:hover:border-indigo-600 hover:bg-indigo-600 dark:hover:bg-indigo-600"><i
                                            class="uil uil-behance" title="Behance"></i></a>
                                </li>
                                <li class="inline">
                                    <a href="http://linkedin.com/company/shreethemes" target="_blank"
                                        class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center border-gray-800 rounded-md border hover:border-indigo-600 dark:hover:border-indigo-600 hover:bg-indigo-600 dark:hover:bg-indigo-600"><i
                                            class="uil uil-linkedin" title="Linkedin"></i></a>
                                </li>
                                <li class="inline">
                                    <a href="https://www.facebook.com/shreethemes" target="_blank"
                                        class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center border-gray-800 rounded-md border hover:border-indigo-600 dark:hover:border-indigo-600 hover:bg-indigo-600 dark:hover:bg-indigo-600"><i
                                            class="uil uil-facebook-f align-middle" title="facebook"></i></a>
                                </li>
                                <li class="inline">
                                    <a href="https://www.instagram.com/shreethemes/" target="_blank"
                                        class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center border-gray-800 rounded-md border hover:border-indigo-600 dark:hover:border-indigo-600 hover:bg-indigo-600 dark:hover:bg-indigo-600"><i
                                            class="uil uil-instagram align-middle" title="instagram"></i></a>
                                </li>
                                <li class="inline">
                                    <a href="https://twitter.com/shreethemes" target="_blank"
                                        class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center border-gray-800 rounded-md border hover:border-indigo-600 dark:hover:border-indigo-600 hover:bg-indigo-600 dark:hover:bg-indigo-600"><i
                                            class="uil uil-twitter align-middle" title="twitter"></i></a>
                                </li>
                            </ul>
                            <!--end icon-->
                        </div>
                        <!--end col-->

                        <div class="lg:col-span-6 md:col-span-12">
                            <h5 class="tracking-[1px] text-gray-100 font-semibold">
                                Danh mục chính
                            </h5>

                            <div class="grid md:grid-cols-12 grid-cols-1">
                                <div class="md:col-span-4">
                                    <ul class="list-none footer-list mt-6">
                                        @foreach($footerCategories->slice(0, 5) as $category)  <!-- Hiển thị 5 danh mục đầu tiên -->
                                            <li class="mt-[10px]">
                                                <a href="{{ route('shop.index', ['category_id' => $category->id]) }}"
                                                    class="text-gray-300 hover:text-gray-400 duration-500 ease-in-out">
                                                    <i class="uil uil-angle-right-b"></i>{{ $category->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <!--end col-->

                                <div class="md:col-span-4">
                                    <ul class="list-none footer-list mt-6">
                                        @foreach($footerCategories->slice(5, 5) as $category)  <!-- Hiển thị 5 danh mục tiếp theo -->
                                            <li class="mt-[10px]">
                                                <a href="{{ route('shop.index', ['category_id' => $category->id]) }}"
                                                    class="text-gray-300 hover:text-gray-400 duration-500 ease-in-out">
                                                    <i class="uil uil-angle-right-b"></i>{{ $category->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <!--end col-->

                                <div class="md:col-span-4">
                                    <ul class="list-none footer-list mt-6">
                                        @foreach($footerCategories->slice(10, 5) as $category)  <!-- Hiển thị 5 danh mục tiếp theo -->
                                            <li class="mt-[10px]">
                                                <a href="{{ route('shop.index', ['category_id' => $category->id]) }}"
                                                    class="text-gray-300 hover:text-gray-400 duration-500 ease-in-out">
                                                    <i class="uil uil-angle-right-b"></i>{{ $category->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <!--end col-->
                            </div>


                        </div>

                        <div class="lg:col-span-3 md:col-span-4">
                            <h5 class="tracking-[1px] text-gray-100 font-semibold">
                                Bản tin
                            </h5>
                            <p class="mt-6">
                                Đăng ký nhận các mẹo mới nhất qua email.
                            </p>
                            <form>
                                <div class="grid grid-cols-1">
                                    <div class="my-3">
                                        <label class="form-label">Nhập email của bạn
                                            <span class="text-red-600">*</span></label>
                                        <div class="form-icon relative mt-2">
                                            <i data-feather="mail" class="size-4 absolute top-3 start-4"></i>
                                            <input type="email"
                                                class="form-input ps-12 rounded w-full py-2 px-3 h-10 bg-gray-800 border-0 text-gray-100 focus:shadow-none focus:ring-0 placeholder:text-gray-200"
                                                placeholder="Email" name="email" required="" />
                                        </div>
                                    </div>

                                    <button type="submit" id="submitsubscribe" name="send"
                                        class="py-2 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white rounded-md">
                                        Subscribe
                                    </button>
                                </div>
                            </form>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end grid-->
                </div>
                <!--end col-->
            </div>
        </div>
        <!--end grid-->

        <div class="grid grid-cols-1">
            <div class="py-[30px] px-0 border-t border-slate-800">
                <div class="grid lg:grid-cols-4 md:grid-cols-2">
                    <div class="flex items-center lg:justify-center">
                        <i class="uil uil-truck align-middle text-lg mb-0 me-2"></i>
                        <h6 class="mb-0 font-medium">Free delivery</h6>
                    </div>
                    <!--end content-->

                    <div class="flex items-center lg:justify-center">
                        <i class="uil uil-archive align-middle text-lg mb-0 me-2"></i>
                        <h6 class="mb-0 font-medium">Non-contact shipping</h6>
                    </div>
                    <!--end content-->

                    <div class="flex items-center lg:justify-center">
                        <i class="uil uil-transaction align-middle text-lg mb-0 me-2"></i>
                        <h6 class="mb-0 font-medium">Money-back quarantee</h6>
                    </div>
                    <!--end content-->

                    <div class="flex items-center lg:justify-center">
                        <i class="uil uil-shield-check align-middle text-lg mb-0 me-2"></i>
                        <h6 class="mb-0 font-medium">Secure payments</h6>
                    </div>
                    <!--end content-->
                </div>
                <!--end grid-->
            </div>
            <!--end-->
        </div>
        <!--end grid-->
    </div>
    <!--end container-->

    <div class="py-[30px] px-0 border-t border-slate-800">
        <div class="container relative text-center">
            <div class="grid md:grid-cols-2 items-center">
                <div class="md:text-start text-center">
                    <p class="mb-0">
                        ©
                        <script>
                            document.write(new Date().getFullYear());
                        </script>
                        Techwind. Design with
                        <i class="mdi mdi-heart text-red-600"></i> by
                        <a href="https://shreethemes.in/" target="_blank" class="text-reset">Shreethemes</a>.
                    </p>
                </div>

                <ul class="list-none md:text-end text-center mt-6 md:mt-0">
                    <li class="inline">
                        <a href="#"><img src="assets/images/payments/american-ex.png" class="max-h-6 inline"
                                title="American Express" alt="" /></a>
                    </li>
                    <li class="inline">
                        <a href="#"><img src="assets/images/payments/discover.png" class="max-h-6 inline"
                                title="Discover" alt="" /></a>
                    </li>
                    <li class="inline">
                        <a href="#"><img src="assets/images/payments/master-card.png" class="max-h-6 inline"
                                title="Master Card" alt="" /></a>
                    </li>
                    <li class="inline">
                        <a href="#"><img src="assets/images/payments/paypal.png" class="max-h-6 inline" title="Paypal"
                                alt="" /></a>
                    </li>
                    <li class="inline">
                        <a href="#"><img src="assets/images/payments/visa.png" class="max-h-6 inline" title="Visa"
                                alt="" /></a>
                    </li>
                </ul>
            </div>
            <!--end grid-->
        </div>
        <!--end container-->
    </div>
</footer>
<!--end footer-->
<!-- Footer End -->

<!-- Start Cookie Popup -->
<div
    class="cookie-popup fixed max-w-lg bottom-3 end-3 start-3 sm:start-0 mx-auto bg-white dark:bg-slate-900 shadow dark:shadow-gray-800 rounded-md py-5 px-6 z-50">
    <p class="text-slate-400">
        This website uses cookies to provide you with a great user experience.
        By using it, you accept our
        <a href="https://shreethemes.in/" target="_blank"
            class="text-emerald-600 dark:text-emerald-500 font-semibold">use of cookies</a>
    </p>
    <div class="cookie-popup-actions text-end">
        <button class="absolute border-none bg-none p-0 cursor-pointer font-semibold top-2 end-2">
            <i class="uil uil-times text-dark dark:text-slate-200 text-2xl"></i>
        </button>
    </div>
</div>
<!--Note: Cookies Js including in plugins.init.js (path like; assets/js/plugins.init.js) and Cookies css including in _helper.scss (path like; scss/_helper.scss)-->
<!-- End Cookie Popup -->

<!-- Back to top -->
<a href="#" onclick="topFunction()" id="back-to-top"
    class="back-to-top fixed hidden text-lg rounded-full z-10 bottom-5 end-5 size-9 text-center bg-indigo-600 text-white leading-9"><i
        class="uil uil-arrow-up"></i></a>
<!-- Back to top -->

<!-- Switcher -->
<div class="fixed top-[30%] -right-2 z-50">
    <span class="relative inline-block rotate-90">
        <input type="checkbox" class="checkbox opacity-0 absolute" id="chk" />
        <label
            class="label bg-slate-900 dark:bg-white shadow dark:shadow-gray-800 cursor-pointer rounded-full flex justify-between items-center p-1 w-14 h-8"
            for="chk">
            <i class="uil uil-moon text-[20px] text-yellow-500"></i>
            <i class="uil uil-sun text-[20px] text-yellow-500"></i>
            <span class="ball bg-white dark:bg-slate-900 rounded-full absolute top-[2px] left-[2px] size-7"></span>
        </label>
    </span>
</div>
<!-- Switcher -->

<!-- LTR & RTL Mode Code -->
<div class="fixed top-[40%] -right-3 z-50">
    <a href="#" id="switchRtl">
        <span
            class="py-1 px-3 relative inline-block rounded-t-md -rotate-90 bg-white dark:bg-slate-900 shadow-md dark:shadow dark:shadow-gray-800 font-bold rtl:block ltr:hidden">LTR</span>
        <span
            class="py-1 px-3 relative inline-block rounded-t-md -rotate-90 bg-white dark:bg-slate-900 shadow-md dark:shadow dark:shadow-gray-800 font-bold ltr:block rtl:hidden">RTL</span>
    </a>
</div>
<!-- LTR & RTL Mode Code -->

<!-- JAVASCRIPTS -->
<script src="{{ asset('assets/libs/shufflejs/shuffle.min.js') }}"></script>
<script src="{{ asset('assets/libs/jarallax/jarallax.min.js') }}"></script>
<script src="{{ asset('assets/libs/tiny-slider/min/tiny-slider.js') }}"></script>
<script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins.init.js') }}"></script>
<script src="{{ asset('assets/js/app.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            const form = this.closest('form');
            const formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
                .then(response => response.json())
                .then(data => {
                    // Cập nhật số lượng giỏ hàng hoặc hiển thị thông báo
                    alert(data.message); // hoặc cập nhật biểu tượng giỏ hàng
                })
                .catch(error => alert('Có lỗi xảy ra khi thêm sản phẩm vào giỏ hàng. Xin vui lòng thử lại.'));
        });
    });

    $(document).ready(function () {
        // Xóa sản phẩm trong giỏ hàng
        $('form[action^="{{ route('cart.remove', '') }}"]').submit(function (event) {
            event.preventDefault(); // Ngăn chặn việc gửi form mặc định
            var form = $(this);
            if (confirm('Bạn chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?')) {
                $.ajax({
                    type: 'DELETE',
                    url: form.attr('action'),
                    data: form.serialize(),
                    success: function (response) {
                        // Xử lý thành công
                        alert('Sản phẩm đã được xóa khỏi giỏ hàng.');
                        form.closest('tr').remove(); // Xóa hàng trong bảng
                        updateTotals(); // Cập nhật lại tổng
                    },
                    error: function (xhr) {
                        // Xử lý lỗi
                        alert('Có lỗi xảy ra khi xóa sản phẩm. Xin vui lòng thử lại.');
                    }
                });
            }
        });

        // Cập nhật số lượng sản phẩm
        $('form[action^="{{ route('cart.update', '') }}"]').submit(function (event) {
            event.preventDefault(); // Ngăn chặn việc gửi form mặc định
            var form = $(this);
            $.ajax({
                type: 'PATCH',
                url: form.attr('action'),
                data: form.serialize(),
                success: function (response) {
                    // Cập nhật giao diện sau khi thành công
                    alert('Giỏ hàng đã được cập nhật thành công!');
                    updateTotals(); // Cập nhật lại tổng
                },
                error: function (xhr) {
                    // Xử lý lỗi
                    alert('Có lỗi xảy ra khi cập nhật sản phẩm. Xin vui lòng thử lại.');
                }
            });
        });

        function updateTotals() {
            let subtotal = 0;
            $('tbody tr').each(function () {
                const price = parseFloat($(this).find('td:nth-child(3)').text().replace('$', ''));
                const quantity = parseInt($(this).find('input[name="quantity"]').val());
                const total = price * quantity;
                $(this).find('td:nth-child(5)').text(`$${total.toFixed(2)}`);
                subtotal += total;
            });

            const taxes = subtotal * 0.1; // Giả sử thuế là 10%
            const total = subtotal + taxes;

            // Cập nhật subtotal, taxes và total trong phần tổng
            $('ul.list-none li:nth-child(1) span.text-slate-400').text(`$${subtotal.toFixed(2)}`);
            $('ul.list-none li:nth-child(2) span.text-slate-400').text(`$${taxes.toFixed(2)}`);
            $('ul.list-none li:nth-child(3) span.font-semibold').text(`$${total.toFixed(2)}`);
        }
    });

    // Lắng nghe sự kiện thay đổi variant
    document.getElementById('variant').addEventListener('change', function () {
        // Cập nhật giá trị của trường variant_id
        document.getElementById('variant_id').value = this.value;
    });

    // Lắng nghe sự kiện thay đổi quantity
    document.querySelector('input[name="quantity"]').addEventListener('input', function () {
        // Cập nhật giá trị của trường quantity
        document.getElementById('quantity').value = this.value;
    });


</script>

<!-- JAVASCRIPTS -->
</body>

<!-- Mirrored from shreethemes.in/techwind/landing/index-shop.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 25 Mar 2024 01:43:15 GMT -->

</html>