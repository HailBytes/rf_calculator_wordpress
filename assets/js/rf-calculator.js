jQuery(document).ready(function($) {
    
    // Calculate button click handler
    $("#rf-calculate-btn").on("click", function() {
        var frequency = $("#rf-frequency-input").val();
        var unit = $("#rf-frequency-unit").val();
        
        if (!frequency || frequency <= 0) {
            alert("Please enter a valid frequency greater than 0");
            return;
        }
        
        // Show loading state
        $(this).prop("disabled", true).text("Calculating...");
        
        $.ajax({
            url: rf_calculator_ajax.ajax_url,
            type: "POST",
            data: {
                action: "calculate_wavelength",
                frequency: frequency,
                unit: unit,
                nonce: rf_calculator_ajax.nonce
            },
            success: function(response) {
                if (response.success) {
                    $("#rf-wavelength-value").text(response.data.wavelength);
                    $("#rf-result-section").slideDown();
                } else {
                    alert("Error: " + response.data);
                }
            },
            error: function() {
                alert("An error occurred during calculation");
            },
            complete: function() {
                $("#rf-calculate-btn").prop("disabled", false).text("Calculate");
            }
        });
    });
    
    // Reset button click handler
    $("#rf-reset-btn").on("click", function() {
        $("#rf-frequency-input").val("");
        $("#rf-frequency-unit").val("kHz");
        $("#rf-result-section").slideUp();
        $("#rf-wavelength-value").text("0");
    });
    
    // Enter key handler for input field
    $("#rf-frequency-input").on("keypress", function(e) {
        if (e.which === 13) {
            $("#rf-calculate-btn").click();
        }
    });
    
    // Auto-calculate when unit changes (optional)
    $("#rf-frequency-unit").on("change", function() {
        var frequency = $("#rf-frequency-input").val();
        if (frequency && frequency > 0) {
            $("#rf-calculate-btn").click();
        }
    });
});