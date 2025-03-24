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
                <span aria-hidden="true">&times;</span>
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
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08), 0 2px 4px rgba(0, 0, 0, 0.06);
        padding: 0;
        margin-bottom: 1rem;
        font-family: 'Segoe UI', sans-serif;
        /* Clean, modern font */
        max-width: 450px;
        /* Compact yet readable */
        background: #fff;
        /* White base for clarity */
        overflow: hidden;
        animation: slideIn 0.3s ease-out;
    }

    .alert-wrapper {
        padding: 12px 16px;
        /* Compact padding */
        position: relative;
        min-height: 60px;
        /* Slimmer profile */
    }

    .alert-header {
        display: flex;
        align-items: center;
        margin-bottom: 6px;
    }

    .alert-icon {
        font-size: 1.5rem;
        /* Balanced icon size */
        margin-right: 12px;
        transition: transform 0.2s ease-in-out;
    }

    .alert-icon:hover {
        transform: scale(1.1);
        /* Subtle hover effect */
    }

    .alert-title {
        margin: 0;
        font-size: 1.1rem;
        /* Clear and bold title */
        font-weight: 700;
        color: #333;
        /* Darker for contrast */
        flex-grow: 1;
        letter-spacing: 0.2px;
    }

    .alert-body {
        margin-left: 27px;
        /* Aligns with icon */
        font-size: 0.9rem;
        /* Readable message */
        color: #555;
        /* Softer text color */
        line-height: 1.3;
    }

    /* Type-specific styling */
    .alert-success {
        border-left: 4px solid #28a745;
        /* Green accent */
    }

    .alert-success .alert-icon,
    .alert-success .alert-title {
        color: #28a745;
    }

    .alert-success .progress-bar {
        background: #28a745;
    }

    .alert-danger {
        border-left: 4px solid #dc3545;
        /* Red accent */
    }

    .alert-danger .alert-icon,
    .alert-danger .alert-title {
        color: #dc3545;
    }

    .alert-danger .progress-bar {
        background: #dc3545;
    }

    .alert-warning {
        border-left: 4px solid #ffc107;
        /* Yellow accent */
    }

    .alert-warning .alert-icon,
    .alert-warning .alert-title {
        color: #ffc107;
    }

    .alert-warning .progress-bar {
        background: #ffc107;
    }

    .alert-info {
        border-left: 4px solid #17a2b8;
        /* Blue accent */
    }

    .alert-info .alert-icon,
    .alert-info .alert-title {
        color: #17a2b8;
    }

    .alert-info .progress-bar {
        background: #17a2b8;
    }

    .btn-close {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        /* background: rgba(0, 0, 0, 0.08); */
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease-in-out;
        font-size: 1rem;
        color: #666;
        opacity: 0.8;
    }

    .btn-close:hover {
        /* background: rgba(0, 0, 0, 0.15); */
        transform: rotate(90deg);
        opacity: 1;
    }

    .progress {
        height: 4px;
        /* Slim progress bar */
        background: rgba(0, 0, 0, 0.05);
        border-radius: 0 0 8px 8px;
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
    }

    .progress-bar {
        width: 100%;
        transition: width 3s ease-out;
        border-radius: 0 0 8px 0;
    }

    @keyframes slideIn {
        0% {
            transform: translateY(-10px);
            opacity: 0;
        }

        100% {
            transform: translateY(0);
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
                alert.style.transform = "translateY(-10px)";
                alert.style.transition = "all 0.3s ease-out";
                setTimeout(() => alert.remove(), 300);
            }, 3000); // Auto-dismiss after 3 seconds
        }
    });
</script>
@endif