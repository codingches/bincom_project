<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Polling Unit Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h4 class="text-center">Add Polling Unit Results</h4>
            </div>
            <div class="card-body">
                <form id="resultForm">
                    <div id="message"></div>

                    <div class="mb-3">
                        <label class="form-label">Polling Unit ID:</label>
                        <input type="number" name="polling_unit_id" id="polling_unit_id" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Party:</label>
                        <input type="text" name="party" id="party" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Score:</label>
                        <input type="number" name="score" id="score" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-success w-100">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
    $("#resultForm").submit(function(e) {
        e.preventDefault(); // Prevent page reload

        $.ajax({
            type: "POST",
            url: "add_results.php",
            data: $(this).serialize(),
            success: function(response) {
                if (response.includes("❌")) {
                    $("#message").html('<div class="alert alert-danger">' + response + '</div>');
                } else {
                    $("#message").html('<div class="alert alert-success">' + response + '</div>');
                    $("#resultForm")[0].reset(); // Reset form fields
                }
            },
            error: function(xhr, status, error) {
                $("#message").html('<div class="alert alert-danger">Something went wrong! ' + error + '</div>');
            }
        });
    });
});

    </script>
</body>
</html>
