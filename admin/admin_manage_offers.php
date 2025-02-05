<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Offers</title>
    <link rel="stylesheet" href="../assets/css/admin_editform_style.css">
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper">
            <?php include 'admin_sidebar.php'; ?>
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Manage Offers</h4>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Image</th>
                                                    <th>Offer Title</th>
                                                    <th>Discount (%)</th>
                                                    <th>Valid From</th>
                                                    <th>Valid Until</th>
                                                    <th>Description</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <img src="https://via.placeholder.com/50" alt="Offer Image"
                                                            class="img-fluid rounded">
                                                    </td>
                                                    <td>Summer Special</td>
                                                    <td>20%</td>
                                                    <td>2025-06-01</td>
                                                    <td>2025-08-31</td>
                                                    <td>Get 20% off on all rooms during summer.</td>
                                                    <td>
                                                        <button class="btn btn-info btn-sm edit-btn"
                                                            data-title="Summer Special" data-discount="20"
                                                            data-from="2025-06-01" data-until="2025-08-31"
                                                            data-description="Get 20% off on all rooms during summer.">
                                                            Edit
                                                        </button>
                                                        <button class="btn btn-danger btn-sm">Delete</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="https://via.placeholder.com/50" alt="Offer Image"
                                                            class="img-fluid rounded">
                                                    </td>
                                                    <td>Weekend Deal</td>
                                                    <td>15%</td>
                                                    <td>2025-02-01</td>
                                                    <td>2025-02-28</td>
                                                    <td>Special weekend discounts on deluxe rooms.</td>
                                                    <td>
                                                        <button class="btn btn-info btn-sm edit-btn"
                                                            data-title="Weekend Deal" data-discount="15"
                                                            data-from="2025-02-01" data-until="2025-02-28"
                                                            data-description="Special weekend discounts on deluxe rooms.">
                                                            Edit
                                                        </button>
                                                        <button class="btn btn-danger btn-sm">Delete</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Edit Offer Modal -->
        <div class="overlay" id="editOfferModal">
            <div class="popup-card">
                <h4 class="card-title">Edit Offer</h4><br><br>
                <form class="form-sample" id="editOfferForm" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Offer Title</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" placeholder="Enter offer title" name="offer_title" id="editOfferTitle">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Discount (%)</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" placeholder="Enter discount percentage" step="0.01" name="discount" id="editDiscount">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Valid From</label>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control" name="valid_from" id="editValidFrom">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Valid Until</label>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control" name="valid_until" id="editValidUntil">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Offer Description</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" rows="3" placeholder="Enter offer details" name="offer_description" id="editOfferDescription"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Offer Image</label>
                                <div class="col-sm-8">
                                    <input type="file" class="form-control" accept="image/*" name="offer_image" id="editOfferImage">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary" style="background-color:rgb(0, 103, 193);">Update Offer</button>
                            <button type="button" class="btn btn-secondary" id="closeModal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <script>
            document.addEventListener("DOMContentLoaded", () => {
                const editOfferModal = document.getElementById("editOfferModal");
                const closeModal = document.getElementById("closeModal");

                // Edit button click handlers
                const editButtons = document.querySelectorAll('.edit-btn');
                editButtons.forEach(button => {
                    button.addEventListener('click', () => {
                        // Populate modal with current offer details
                        const title = button.getAttribute('data-title');
                        const discount = button.getAttribute('data-discount');
                        const validFrom = button.getAttribute('data-from');
                        const validUntil = button.getAttribute('data-until');
                        const description = button.getAttribute('data-description');

                        document.getElementById('editOfferTitle').value = title;
                        document.getElementById('editDiscount').value = discount;
                        document.getElementById('editValidFrom').value = validFrom;
                        document.getElementById('editValidUntil').value = validUntil;
                        document.getElementById('editOfferDescription').value = description;

                        // Show the modal
                        editOfferModal.style.display = "flex";
                    });
                });

                // Close modal when clicking outside
                editOfferModal.addEventListener('click', (e) => {
                    if (e.target === editOfferModal) {
                        editOfferModal.style.display = "none";
                    }
                });

                closeModal.addEventListener("click", () => {
                    editOfferModal.style.display = "none";
                });

                // Handle form submission (you'd replace this with actual save logic)
                // document.getElementById('editOfferForm').addEventListener('submit', (e) => {
                //     e.preventDefault();
                //     alert('Offer updated! (In a real application, this would save to a database)');
                //     editOfferModal.style.display = "none";
                // });
            });

            $(document).ready(function() {
                // Custom file size validation method
                $.validator.addMethod("filesize", function(value, element, param) {
                    return this.optional(element) || (element.files[0].size <= param);
                }, "File size must be less than 2MB");

                $('#editOfferForm').validate({
                    rules: {
                        offer_title: {
                            required: true,
                            minlength: 3,
                            maxlength: 50
                        },
                        discount: {
                            required: true,
                            number: true,
                            min: 0,
                            max: 100
                        },
                        valid_from: {
                            required: true,
                            date: true
                        },
                        valid_until: {
                            required: true,
                            date: true
                        },
                        offer_description: {
                            required: true,
                            minlength: 10
                        },
                        offer_image: {
                            required: true,
                            extension: "jpg|jpeg|png|gif",
                            filesize: 2097152 // 2MB
                        }
                    },
                    messages: {
                        offer_title: {
                            required: "Offer title is required",
                            minlength: "Offer title must be at least 3 characters",
                            maxlength: "Offer title cannot exceed 50 characters"
                        },
                        discount: {
                            required: "Discount percentage is required",
                            number: "Enter a valid number",
                            min: "Discount cannot be less than 0%",
                            max: "Discount cannot exceed 100%"
                        },
                        valid_from: {
                            required: "Please select the start date",
                            date: "Enter a valid date"
                        },
                        valid_until: {
                            required: "Please select the end date",
                            date: "Enter a valid date"
                        },
                        offer_description: {
                            required: "Offer description is required",
                            minlength: "Description must be at least 10 characters"
                        },
                        offer_image: {
                            required: "Offer image is required",
                            extension: "Only JPG, JPEG, PNG, or GIF files are allowed",
                            filesize: "File size must be less than 2MB"
                        }
                    },
                    errorElement: "div",
                    errorPlacement: function(error, element) {
                        error.addClass('invalid-feedback');
                        error.insertAfter(element);
                    },
                    highlight: function(element) {
                        $(element).addClass('is-invalid').removeClass('is-valid');
                    },
                    unhighlight: function(element) {
                        $(element).addClass('is-valid').removeClass('is-invalid');
                    }
                });

                // Prevent form submission if validation fails
                $('#editOfferForm').submit(function(e) {
                    if (!$(this).valid()) {
                        e.preventDefault();
                    }
                });
            });
        </script>
</body>

</html>