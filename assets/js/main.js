// DELETE POST VARIABLES
let deletePostBtn      = document.querySelectorAll('button[name="delete_post"]');
const displayPostWrapper = document.querySelector('.col-8.pt-4');
const displayPostSection = document.querySelectorAll('.col-8.pt-4 .row');
const postID             = document.querySelectorAll('#delete-post-id');

// SUBMIT POST VARIABLES
const submitPostBtn = document.querySelector('#submit-post-button');
const submitPostID  = document.querySelector('#submit-post-id');
const submitPostContent  = document.querySelector('#submit-post-content');
const submitPostName  = document.querySelector('#submit-post-name');

// GET REQUEST TO RETRIEVE EVERY POST
const get = (url) => {
  return new Promise((resolve, reject) => {
    const xhttp = new XMLHttpRequest();
    
    xhttp.open('GET', url, true);
    
    xhttp.onload = () => {
      if (xhttp.status == 200) {
        resolve(JSON.parse(xhttp.response));
      } else {
        reject(xhttp.statusText);
      }
    };
    
    xhttp.onerror = () => {
      reject(xhttp.statusText);
    };
    
    xhttp.send();
  });
}

// DELETE SPECIFIC POST
const deletePostPromise = (url, postID) => {
  return new Promise((resolve, reject) => {
    const xhr = new XMLHttpRequest();
    
    xhr.open('POST', url, true);
    
    xhr.onload = () => {
      if (xhr.status == 200) {
        console.log('if (xhr.status == 200)');
        resolve();
      } else {
        reject(xhr.statusText);
      }
    };
    
    xhr.onerror = () => {
      reject(xhr.statusText);
    };
    
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send(postID);
  });
}

// SUBMIT A NEW POST
const submitPost = (url, user_id, user_name, content) => {
  return new Promise((resolve, reject) => {
    const xhr = new XMLHttpRequest();
    
    xhr.open('POST', url, true);
    
    xhr.onload = () => {
      if (xhr.status == 200) {
        console.log('resolving');
        resolve();
      } else {
        reject(xhr.statusText);
      }
    };
    
    xhr.onerror = () => {
      reject(xhr.statusText);
    };
    
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send(user_id, user_name, content);
  });
};

// RETURN THE NEWEST BLOG POST
const returnNewestPost = (url) => {
  return new Promise((resolve, reject) => {
    const xhr = new XMLHttpRequest();
    
    xhr.open('GET', url, true);
    
    xhr.onload = () => {
      if (xhr.status == 200) {
        console.log('resolving');
        resolve(JSON.parse(xhr.response));
      } else {
        reject(xhr.statusText);
      }
    };
    
    xhr.onerror = () => {
      reject(xhr.statusText);
    };
    
    xhr.send();
  });
}

// MAKING THE CALL TO DELETE THE POST
const delPostFunc = () => {
  console.log(deletePostBtn);
  deletePostBtn = document.querySelectorAll('button[name="delete_post"]');
  console.log(deletePostBtn);
  
  if (deletePostBtn) {  
    for (let i = 0; i < deletePostBtn.length; i++) {
      deletePostBtn[i].addEventListener('click', e => {
        e.preventDefault();
        console.log(deletePostBtn);
        
        displayPostSection[i].remove();
        
        // ${postID[i]} comes from `const postID` at the top
        deletePostPromise('http://localhost/mouthblog/ajax/delete_post.ajax.php', `id=${postID[i].value}`);
      });
    }
  }
}
// CALL `delPostFunc()` FOR THE INITIAL `deletePostBtn` ON SCREEN
delPostFunc();

// MAKING CALL TO SUBMIT NEW POST
if (submitPostBtn) {
  submitPostBtn.addEventListener('click', e => {
    e.preventDefault();
    
    // SUBMIT POST
    submitPost('http://localhost/mouthblog/ajax/submit_post.ajax.php',
      `id=${submitPostID.value}&name=${submitPostName.value}&content=${submitPostContent.value}`);
    
    // RETURN THAT SAME POST
    returnNewestPost('http://localhost/mouthblog/api/newest_post.php');
    
    // INSERT POST INTO DOM
    const newPostDiv = document.createElement('div');
    newPostDiv.setAttribute('class', 'row');
    newPostDiv.innerHTML = `
                            <article class="col-10 offset-1">
                              <h2 class="h2">USERNAME</h2>
                              <small>DATE CREATED</small>
                              &nbsp;
                              &nbsp;
                              <form action="/mouthblog/blog.php" method="POST">
                                <button class="btn btn-danger" name="delete_post" type="submit">DELETE</button>
                                <input id="delete-post-id" name="post_id" type="hidden" value="USER ID">
                              </form>
                              <hr>
                              <p class="lead">CONTENT</p>
                            </article>
    `;
    
    displayPostWrapper.prepend(newPostDiv);
    
    // GIVE THE `newPostDiv`'s `delete button` THE CLICK EVENT HANDLER
    delPostFunc(); // BOOM!
  });
}
