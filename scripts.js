// Event listener for the "Sign Up" button
const signupButton = document.getElementById("signupButton");
if (signupButton) {
    signupButton.addEventListener("click", function() {
        window.location.href = "http://localhost/webproject/signup.php"; // Navigates to the signup page
    });
}

// Event listener for the "Log In" button
const loginButton = document.getElementById("loginButton");
if (loginButton) {
    loginButton.addEventListener("click", function() {
        window.location.href = "http://localhost/webproject/login.html"; // Ensure you are redirecting to the correct PHP page
    });
}

// Event listener for the "Back" button on the signup page and home page
const backButton = document.getElementById("backButton");
if (backButton) {
    backButton.addEventListener("click", function() {
        window.location.href = "http://localhost/webproject/index.html"; // Ensure the filename is correct and consistent
    });
}
document.addEventListener('DOMContentLoaded', () => {
    const reviewForm = document.getElementById('reviewForm');

    reviewForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        // Gather form data
        const rating = document.getElementById('userRating').value;
        const review = document.getElementById('userReview').value;
        const movieTitle = "Jersey"; // Adjust this if needed for different movie pages

        // Create a FormData object to send with fetch
        const formData = new FormData();
        formData.append('rating', rating);
        formData.append('review', review);
        formData.append('movie_title', movieTitle);

        // Use fetch to send data to the server
        fetch('submit_review.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(data => {
            alert("Review submitted successfully!");
            // Optionally reset the form
            reviewForm.reset();
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
            alert("There was an error submitting your review. Please try again.");
        });
    });
});

