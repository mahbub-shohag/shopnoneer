function fetchOptions(url, data, targetSelect, clearSelect = null) {
    $.ajax({
        url: url,
        type: 'POST',
        data: data,
        success: function (response) {
            $(targetSelect).html(response);
            if (clearSelect) {
                $(clearSelect).html('<option value="">Select Option</option>');
            }
        },
        error: function () {
            alert("Error fetching data. Please try again.");
        }
    });
}

$('#divisionSelect').change(function () {
    let divisionId = $(this).val();
    fetchOptions(
        "/districts_by_division_id",
        {_token: $("meta[name='csrf-token']").attr("content"), division_id: divisionId},
        '#districtSelect',
        '#upazilaSelect'
    );
});

$('#districtSelect').change(function () {
    let districtId = $(this).val();
    fetchOptions(
        "/upazillas_by_district_id",
        {_token: $("meta[name='csrf-token']").attr("content"), district_id: districtId},
        '#upazilaSelect',
    );
});


// For Create Project
$('.upazila-select-facilities').change(function () {
    let upazila_id = $(this).val();
    $.ajax({
        url: "/facilities_by_upazila_id",  // Ensure this is the correct route
        data: {
            "_token": $("meta[name='csrf-token']").attr("content"),  // Ensure CSRF token is passed correctly
            'upazila_id': upazila_id
        },
        type: 'POST',
        dataType: 'json',
        success: function (groupedFacilities) {
            $('#facility-cards').html(''); // Clear previous facilities cards

            // Ensure groupedFacilities is structured correctly
            $.each(groupedFacilities, function (categoryId, category) {
                let categoryLabel = category[0].category.label; // Adjust this based on the data structure
                let cardHTML = `<div class="col-md-6 mb-4"><div class="card"><div class="card-header bg-teal text-white">${categoryLabel}</div><div class="card-body">`;

                $.each(category, function (index, facility) {
                    cardHTML += `

                       <div class="form-check">
                        <input class="form-check-input initially-all-check-box" type="checkbox" name="facilities[${facility.id}]" value="${facility.id}"
                        onchange="toggleCheckboxBackground(this)"
                        >
                       <label class="form-check-label">${facility.name}</label>
                        </div>

                    `;
                });

                cardHTML += '</div></div></div>';
                $('#facility-cards').append(cardHTML);
            });
        },
        error: function (xhr, status, error) {
            console.log("Error Status: " + status);
            console.log("Error Message: " + error);
            console.log(xhr.responseText);  // Log detailed error information
            alert("Error loading facilities.");
        }
    });
});


$('.upazila-select-housing').change(function () {
    let upazilaId = $(this).val();

    // AJAX request to load housing based on selected upazila
    $.ajax({
        url: "/housings_by_upazila_id", // Housing endpoint
        type: 'POST',
        data: {
            _token: $("meta[name='csrf-token']").attr("content"),
            upazila_id: upazilaId
        },
        success: function (result) {
            // Clear previous housing options
            $('select[name="housing_id"]').html('');
            $('select[name="housing_id"]').append(result); // Add new housing options
        },
        error: function () {
            alert("Error loading housings.");
        }
    });
});


//  Here use the customized Checked-Box
function toggleCheckboxBackground(c) {
    c.style.backgroundColor = c.checked ? 'teal' : 'white';
    c.style.borderColor = 'teal';
}

// Initialize background color for all checkboxes on page load
document.addEventListener("DOMContentLoaded", function() {
    const checkboxes = document.querySelectorAll(".initially-all-check-box"); // Select all checkboxes with the class 'custom-checkbox'
    checkboxes.forEach(c => {
        toggleCheckboxBackground(c); // Apply initial background color
    });
});

// prevent the form submission on enter button

$('.preventSubmit input[type="text"]').on('keydown', function (event) {
    if (event.key === 'Enter') {
        event.preventDefault();
    }
});