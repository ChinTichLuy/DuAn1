@isset($_SESSION['toastr'])
    <script>
        toastr.options = {
            "progressBar": true,
            "timeOut": 5000,
            "closeButton": true,
            "positionClass": "toast-top-center"
        }
        toastr["{{ $_SESSION['toastr']['icon'] ?? 'success' }}"]("{{ $_SESSION['toastr']['message'] ?? '' }}",
            "{{ $_SESSION['toastr']['title'] }}");
    </script>
@endisset
