{{-- @if ($message)
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
@endif --}}

{{-- @if ($message)
<div id="{{ $id }}" class="alert alert-custom alert-{{ $type }} alert-dismissible fade show" role="alert">
    <div class="alert-content">
        <div class="alert-icon">
            @switch($type)
            @case('success')
            <i class="fas fa-check-circle"></i>
            @break
            @case('danger')
            <i class="fas fa-exclamation-triangle"></i>
            @break
            @case('warning')
            <i class="fas fa-exclamation-circle"></i>
            @break
            @default
            <i class="fas fa-info-circle"></i>
            @endswitch
        </div>
        <div class="alert-message">
            <strong>{{ $title }}</strong> {{ $message }}
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>

    <!-- Progress Bar -->
    <div class="progress">
        <div id="{{ $id }}-progress" class="progress-bar"></div>
    </div>
</div>

<style>
    .alert-custom {
        border: none;
        border-radius: 10px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        padding: 0;
        overflow: hidden;
        margin-bottom: 1.5rem;
        font-size: 1.1rem;
        /* Slightly larger text */
        max-width: 600px;
        /* Slightly wider */
        animation: fadeIn 0.3s ease-out;
    }

    .alert-content {
        display: flex;
        align-items: center;
        padding: 20px 25px;
        /* Larger padding */
        min-height: 80px;
        /* Taller alert */
    }

    .alert-icon {
        margin-right: 20px;
        font-size: 2rem;
        /* Larger icons */
        opacity: 0.95;
        filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
    }

    .alert-message {
        flex-grow: 1;
        margin-right: 20px;
        line-height: 1.4;
    }

    .alert-success {
        background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%);
        color: white;
    }

    .alert-danger {
        background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
        color: white;
    }

    .alert-warning {
        background: linear-gradient(135deg, #f1c40f 0%, #e67e22 100%);
        color: white;
    }

    .alert-info {
        background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
        color: white;
    }

    .btn-close {
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        width: 30px;
        /* Larger close button */
        height: 30px;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0.8;
        transition: all 0.3s ease;
        font-size: 1.2rem;
    }

    .btn-close:hover {
        background: rgba(255, 255, 255, 0.3);
        opacity: 1;
        transform: rotate(90deg);
    }

    .progress {
        height: 6px;
        /* Thicker progress bar */
        background: rgba(0, 0, 0, 0.15);
        border-radius: 0;
    }

    .progress-bar {
        width: 100%;
        transition: width 3s linear;
        background: rgba(255, 255, 255, 0.3);
        border-radius: 0;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
            let alert = document.getElementById("{{ $id }}");
            let progressBar = document.getElementById("{{ $id }}-progress");

            if (alert && progressBar) {
                setTimeout(() => {
                    progressBar.style.width = "0%";
                }, 100);

                setTimeout(() => {
                    alert.style.opacity = "0";
                    alert.style.transition = "opacity 0.3s ease-out";
                    setTimeout(() => alert.remove(), 300);
                }, 3000);
            }
        });
</script>
@endif --}}

@if ($message)
<div id="{{ $id }}" class="alert alert-custom alert-{{ $type }} alert-dismissible fade show" role="alert">
    <div class="alert-wrapper">
        <div class="alert-header">
            <div class="alert-icon">
                @switch($type)
                @case('success')
                <i class="fas fa-check-circle"></i>
                @break
                @case('danger')
                <i class="fas fa-exclamation-triangle"></i>
                @break
                @case('warning')
                <i class="fas fa-exclamation-circle"></i>
                @break
                @default
                <i class="fas fa-info-circle"></i>
                @endswitch
            </div>
            <h5 class="alert-title">{{ $title }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="alert-body">
            <p>{{ $message }}</p>
        </div>
        <div class="progress">
            <div id="{{ $id }}-progress" class="progress-bar"></div>
        </div>
    </div>
</div>

<style>
    .alert-custom {
        border: none;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1),
            0 1px 5px rgba(0, 0, 0, 0.05);
        padding: 0;
        margin-bottom: 1.25rem;
        font-size: 1rem;
        /* Balanced text size */
        max-width: 500px;
        /* More compact width */
        background: rgba(255, 255, 255, 0.97);
        backdrop-filter: blur(8px);
        overflow: hidden;
        animation: popIn 0.3s ease-out;
    }

    .alert-wrapper {
        position: relative;
        padding: 15px 20px;
        /* Reduced padding */
        min-height: 70px;
        /* More compact height */
    }

    .alert-header {
        display: flex;
        align-items: center;
        margin-bottom: 8px;
    }

    .alert-icon {
        font-size: 1.8rem;
        /* Slightly smaller icon */
        margin-right: 15px;
        transition: transform 0.2s ease;
    }

    .alert-icon:hover {
        transform: scale(1.05);
    }

    .alert-title {
        margin: 0;
        font-size: 1.15rem;
        /* Slightly smaller title */
        font-weight: 600;
        flex-grow: 1;
        text-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
    }

    .alert-body {
        margin-left: 35px;
        /* Adjusted for smaller icon */
        font-size: 0.95rem;
        /* Slightly smaller message */
        line-height: 1.4;
        opacity: 0.9;
    }

    .alert-success .alert-icon,
    .alert-success .alert-title {
        color: #27ae60;
    }

    .alert-danger .alert-icon,
    .alert-danger .alert-title {
        color: #c0392b;
    }

    .alert-warning .alert-icon,
    .alert-warning .alert-title {
        color: #e67e22;
    }

    .alert-info .alert-icon,
    .alert-info .alert-title {
        color: #2980b9;
    }

    .alert-success .progress-bar {
        background: linear-gradient(90deg, #27ae60, #2ecc71);
    }

    .alert-danger .progress-bar {
        background: linear-gradient(90deg, #c0392b, #e74c3c);
    }

    .alert-warning .progress-bar {
        background: linear-gradient(90deg, #e67e22, #f1c40f);
    }

    .alert-info .progress-bar {
        background: linear-gradient(90deg, #2980b9, #3498db);
    }

    .btn-close {
        width: 26px;
        /* Smaller close button */
        height: 26px;
        border-radius: 50%;
        background: rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        font-size: 1.1rem;
        color: inherit;
        opacity: 0.7;
    }

    .btn-close:hover {
        background: rgba(0, 0, 0, 0.15);
        transform: scale(1.1) rotate(90deg);
        opacity: 1;
    }

    .progress {
        height: 5px;
        /* Thinner progress bar */
        background: rgba(0, 0, 0, 0.05);
        border-radius: 0 0 10px 10px;
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
    }

    .progress-bar {
        width: 100%;
        transition: width 3s ease-out;
        border-radius: 0 0 10px 0;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    @keyframes popIn {
        0% {
            transform: scale(0.95);
            opacity: 0;
        }

        100% {
            transform: scale(1);
            opacity: 1;
        }
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
            let alert = document.getElementById("{{ $id }}");
            let progressBar = document.getElementById("{{ $id }}-progress");

            if (alert && progressBar) {
                setTimeout(() => {
                    progressBar.style.width = "0%";
                }, 100);

                setTimeout(() => {
                    alert.style.opacity = "0";
                    alert.style.transform = "scale(0.98)";
                    alert.style.transition = "all 0.3s ease-out";
                    setTimeout(() => alert.remove(), 300);
                }, 3000);
            }
        });
</script>
@endif