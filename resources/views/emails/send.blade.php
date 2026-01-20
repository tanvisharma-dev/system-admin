@extends('layouts.admin')

@section('title', 'Send Email')

@section('styles')
<style>
    .form-floating > .form-control:focus ~ label,
    .form-floating > .form-control:not(:placeholder-shown) ~ label {
        color: #3490dc;
        opacity: 0.8;
    }
    
    .form-control:focus {
        border-color: #3490dc;
        box-shadow: 0 0 0 0.25rem rgba(52, 144, 220, 0.25);
    }
    
    .card {
        border-radius: 12px;
        overflow: hidden;
    }
    
    .card-header {
        background-color: #fff;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    textarea.form-control {
        border-radius: 8px;
    }
    
    .btn-primary {
        background-color: #3490dc;
        border-color: #3490dc;
        transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
        background-color: #2779bd;
        border-color: #2779bd;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(39, 121, 189, 0.3);
    }
</style>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="mb-0"><i class="fas fa-paper-plane text-primary me-2"></i>Send Email</h3>
                        <a onclick="history.back()" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Back
                        </a>
                    </div>
                    <div class="card-body p-4">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show">
                                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show">
                                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        
                        <form action="{{ route('emails.send') }}" method="POST">
                            @csrf
                            <div class="row mb-4">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="from" name="from" value="{{ auth()->user()->email ?? '' }}" required>
                                        <label for="from"><i class="fas fa-user me-2"></i>From (Your Email)</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="to" name="to" required>
                                        <label for="to"><i class="fas fa-user-plus me-2"></i>To</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="subject" name="subject" required>
                                    <label for="subject"><i class="fas fa-heading me-2"></i>Subject</label>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="body" class="form-label"><i class="fas fa-envelope-open-text me-2"></i>Message:</label>
                                <textarea class="form-control" id="body" name="body" rows="12" required style="resize: vertical;"></textarea>
                            </div>
                            
                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('emails.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-times me-2"></i>Cancel
                                </a>
                                <button type="submit" class="btn btn-primary px-4 py-2">
                                    <i class="fas fa-paper-plane me-2"></i>Send Email
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Add character counter for message field
        const messageField = $('#body');
        const maxLength = 5000; // Set a reasonable max length
        
        // Create and append character counter
        const counterDiv = $('<div class="text-muted mt-2 d-flex justify-content-between"></div>');
        const counter = $('<small><span id="char-count">0</span>/' + maxLength + ' characters</small>');
        const counterHelp = $('<small><i class="fas fa-info-circle me-1"></i>Press Ctrl+Enter to send</small>');
        
        counterDiv.append(counter);
        counterDiv.append(counterHelp);
        messageField.after(counterDiv);
        
        // Update character count on input
        messageField.on('input', function() {
            const remaining = $(this).val().length;
            $('#char-count').text(remaining);
            
            // Change color based on length
            if (remaining > maxLength * 0.9) {
                $('#char-count').addClass('text-danger');
            } else if (remaining > maxLength * 0.7) {
                $('#char-count').removeClass('text-danger').addClass('text-warning');
            } else {
                $('#char-count').removeClass('text-danger text-warning');
            }
        });
        
        // Allow Ctrl+Enter to submit form
        messageField.on('keydown', function(e) {
            if (e.ctrlKey && e.keyCode === 13) {
                $(this).closest('form').submit();
            }
        });
        
        // Form validation
        $('form').on('submit', function(e) {
            let isValid = true;
            
            // Simple validation
            $(this).find('[required]').each(function() {
                if (!$(this).val()) {
                    isValid = false;
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                toastr.error('Please fill in all required fields');
            } else {
                // Show loading state
                const submitBtn = $(this).find('button[type="submit"]');
                const originalText = submitBtn.html();
                submitBtn.html('<i class="fas fa-spinner fa-spin me-2"></i>Sending...');
                submitBtn.prop('disabled', true);
                
                // Reset button after 10 seconds in case of network issues
                setTimeout(function() {
                    if (submitBtn.prop('disabled')) {
                        submitBtn.html(originalText);
                        submitBtn.prop('disabled', false);
                    }
                }, 10000);
            }
        });
    });
</script>
@endsection
