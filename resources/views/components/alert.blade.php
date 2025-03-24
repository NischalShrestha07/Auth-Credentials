@if ($message)
    <div id="{{ $id }}" class="alert alert-{{ $type }} alert-dismissible fade show alert-custom" role="alert">
        <strong>{{ $title }}</strong> {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

        <!-- Progress Bar -->
        <div class="progress">
            <div id="{{ $id }}-progress" class="progress-bar bg-{{ $type }}"></div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let alert = document.getElementById("{{ $id }}");
            let progressBar = document.getElementById("{{ $id }}-progress");

            if (alert && progressBar) {
                setTimeout(() => {
                    progressBar.style.width = "0%";
                }, 100);

                setTimeout(() => {
                    alert.classList.remove('show');
                    setTimeout(() => alert.remove(), 500);
                }, 3000);
            }
        });
    </script>
@endif
