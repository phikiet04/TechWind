<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
<script src="node_modules/chart.js/dist/chart.umd.js"></script>
<script src="node_modules/@coreui/chartjs/dist/js/coreui-chartjs.js"></script>
<script src="node_modules/@coreui/utils/dist/umd/index.js"></script>
<script src="node_modules/@coreui/coreui/dist/js/coreui.bundle.min.js"></script>
<script src="node_modules/simplebar/dist/simplebar.min.js"></script>

<script>
    const header = document.querySelector('header.header');
    document.addEventListener('scroll', () => {
        if (header) {
            header.classList.toggle('shadow-sm', document.documentElement.scrollTop > 0);
        }
    });
</script>