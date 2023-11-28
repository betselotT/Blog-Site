console.log("123")
function fetchData() {
    fetch('./blogs.json')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            displayBlogData(data); // Call a separate function to display the fetched data
        })
        .catch(error => {
            console.error('There was a problem fetching the data:', error);
        });
}

function displayBlogData(data) {
    const blogList = document.getElementById('blogList');

    // Clear any previous content in the blogList div
    blogList.innerHTML = '';

    // Iterate through the blog entries and create list items to display them
    data.forEach(blog => {
        const listItem = document.createElement('li');
        listItem.innerHTML = `<strong>User ID:</strong> ${blog.id}<br>
                            <strong>Name:</strong> ${blog.name}<br>
                            <strong>Blog:</strong> ${blog.blog}<br><br>`;
        blogList.appendChild(listItem);
    });
}

// Call the fetchData function when the page loads
document.addEventListener('DOMContentLoaded', fetchData);
