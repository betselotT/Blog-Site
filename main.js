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
        })
        .catch(error => {
            console.error('There was a problem fetching the data:', error);
        });
}

function displayBlogData(data) {
    const blogList = document.getElementById('blogList');

    blogList.innerHTML = '';

    data.forEach(blog => {
        const listItem = document.createElement('li');
        listItem.innerHTML = `<strong>User ID:</strong> ${blog.id}<br>
                            <strong>Name:</strong> ${blog.name}<br>
                            <strong>Blog:</strong> ${blog.blog}<br><br>`;
        blogList.appendChild(listItem);
    });
}

document.addEventListener('DOMContentLoaded', fetchData);
