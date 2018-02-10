require([ 'ajax_requests' ], function (aR) {
  /*********************
  ** GLOBAL VARIABLES **
  *********************/
  const ajaxRequests = new aR.AJAXRequests;
  
  const submitPostBtn     = document.querySelector('#submit-post-button');
  const submitPostID      = document.querySelector('#submit-post-id');
  const submitPostContent = document.querySelector('#submit-post-content');
  const submitPostName    = document.querySelector('#submit-post-name');

  const heartIconBtn = document.querySelectorAll('.heart-post-button');

  const displayPostWrapper = document.querySelector('.col-8.pt-4');
  
  const submitCommentBtn         = document.querySelector('button[name="submit_comment"]');
  const postModalCommentsWrapper = document.querySelector('.post-modal-comments-wrapper');
  const postModalInner           = document.querySelector('.post-modal-inner');
  const commentsContainer        = document.createElement('div');
  
  commentsContainer.setAttribute('class', 'post-modal-comments-wrapper');
  
  /******************************************************
  ** PLACE `liked` CLASS ON HEARTED POSTS ON PAGE LOAD **
  *******************************************************/
  window.addEventListener('load', () => {
    for (let i = 0; i < heartIconBtn.length; i++) {
      if (heartIconBtn[i].classList[1] === 'liked') {
        heartIconBtn[i].children[0].children[0].classList.add('liked');
      }
    }
  });

  /*******************************
  ** INERACTION WITH BLOG POSTS **
  *******************************/
  if (displayPostWrapper && submitPostBtn) {
    const body                = document.querySelector('body');
    const postModal           = document.querySelector('.post-modal-outer');
    const postModalClose      = document.querySelector('.post-modal-close');
    const postModalHeartCount = document.querySelector('#post-modal-heart-count');
    const heartIcon           = document.querySelector('.fa-heart');
      
    // EVENT DELEGATION TO HANDLE ON CLICK EVENTS
    displayPostWrapper.addEventListener('click', e => {
      // POST MODAL FUNC
      const postModalFunc = (childrenPath, postIDPath, heartCountPath) => {
        const { children }        = e.path[childrenPath];
        const postID              = e.path[postIDPath].children[5].value;
        const userName            = children[0].innerText;
        const dateCreated         = children[1].innerText;
        const content             = children[4].innerText || children[3].innerText;
        const deletePostButton    = children[2]['0'];
        const postModalUsername   = document.querySelector('#post-modal-username');
        const postCreatedOn       = document.querySelector('#post-modal-created-on');
        const postModalContent    = document.querySelector('#post-modal-content');
        const postModalPostID     = document.querySelector('.post-modal-post-id');
        
        // PREVENT SCROLLING
        body.style.height   = '100%';
        body.style.overflow = 'hidden';
        
        // ADD `postModal` CSS
        postModal.style.display        = 'flex';
        postModal.style.justifyContent = 'center';
        
        // DYNAMICALLY INSERT CONTENT
        postModalUsername.innerText = userName;
        postCreatedOn.innerText     = dateCreated;
        postModalContent.innerText  = content;
        postModalPostID.value       = postID;
      };
      
      // UNHEART POST
      const unHeartPost = (icon, formPath, idPath, userPath, url = '//localhost/mouthblog/ajax/unheart_post.ajax.php') => {
        e.preventDefault();
        
        const heartIcon = e.path[icon];
        heartCount      = e.path[formPath].children[3];
        heartCountNum   = Number(heartCount.innerText);
        const post_id   = e.path[formPath].children[idPath];
        const user_id   = e.path[formPath].children[userPath];
        
        const data = {
          post_id: post_id.value,
          user_id: user_id.value,
        };
        
        heartCountNum--;
        
        heartCount.innerText = heartCountNum;
        heartIcon.classList.remove('liked');
        
        ajaxRequests.unHeartPost(url, `post_id=${ data.post_id }&user_id=${ data.user_id }`);
      };
      
      // HEARTFUNC
      const heartFunc = (icon, formPath, url = '//localhost/mouthblog/ajax/heart_post.ajax.php') => {
        e.preventDefault();
        const heartIcon = e.path[icon];
        let heartCount = e.path[formPath].children[3];
        let heartCountNum = Number(heartCount.innerText);
        const post_id = e.path[formPath].children[5];
        const user_id = e.path[formPath].children[6];
        const data = {
          post_id: post_id.value,
          user_id: user_id.value,
        };
        
        heartCountNum++;
        heartCount.innerText = heartCountNum;
        heartIcon.classList.add('liked');
        
        ajaxRequests.heartPost(url, `post_id=${data.post_id}&user_id=${data.user_id}`);
      };
      
      // RETURN ALL COMMENTS FOR PARTICULAR POST
      const returnAllComments = (postIDPath) => {
        const postID = e.path[postIDPath].children[5].value;
        
        ajaxRequests.returnCurrentPostComments(`post_id=${ postID }`)
          .then(data => {
            console.log(data);
            
            commentsContainer.innerHTML = data.map(d => {
                return `<div class="post-modal-comment mb-4">
                          <div class="post-modal-comment-header mb-2">
                            <p class="mb-0">${ d.username }</p>
                            <small>${ d.date_created }</small>
                          </div>
                          <div class="post-modal-comment-content">
                            <p>${ d.comment_content }</p>
                          </div>
                        </div>
                ` ;
              }).join('');
              
            postModalInner.append(commentsContainer);
          });
      }
      
      // CHECK IF DELETE BUTTON WAS CLICKED
      if (e.target.className === 'btn btn-danger') {
        e.preventDefault();
        
        const { parentElement }        = e.target;
        const row                      = parentElement.parentElement.parentElement;
        const form                     = parentElement;
        const postID                   = form.children[1].value;
        const userID                   = form.children[2].value;
        
        row.style.opacity = '0';
        
        ajaxRequests.deletePostPromise('http://localhost/mouthblog/ajax/delete_post.ajax.php', `id=${postID}`);
        ajaxRequests.unHeartPost('//localhost/mouthblog/ajax/unheart_post.ajax.php', `post_id=${ postID }&user_id=${ userID }`);
        
        setTimeout(() => {
          row.remove();
        }, 1000);
        
      // CHECK IF COMMENT ICON WAS CLICKED
      } else if (e.path[0].className.baseVal === 'svg-inline--fa fa-comment-alt fa-w-18 fa-lg') {
        returnAllComments(2);
        postModalFunc(3, 2, 2);
        
      // SECOND CHECK IF COMMENT ICON WAS CLICKED
      } else if (e.path[1].className.baseVal === 'svg-inline--fa fa-comment-alt fa-w-18 fa-lg') {
        returnAllComments(3);
        postModalFunc(4, 3, 3);
        
      // IF ALREADY `hearted` THEN REMOVE IT
      } else if (e.path[1].classList[4] === 'liked') {
        e.preventDefault();
        unHeartPost(1, 4, 5, 6);
        
      // IF ALREADY `hearted` THEN REMOVE IT
      } else if (e.path[0].className.baseVal === 'svg-inline--fa fa-heart fa-w-18 fa-lg liked') {
        e.preventDefault();
        unHeartPost(0, 3, 5, 6);
        
      // !!DONT DO ANYTHING!!
      } else if (e.path[0].className === 'heart-post-button') {
        e.preventDefault();
      
      // CHECK IF HEART ICON WAS CLICKED FROM `path`
      } else if (e.path[0].parentElement.classList[1] === 'fa-heart') {
        e.preventDefault();
        heartFunc(1, 4);

      // CHECK IF HEART ICON WAS CLICKED FROM `svg`
      } else if (e.path[0].classList[1] === 'fa-heart') {
        e.preventDefault();
        heartFunc(0, 3);
      }
    }); // click event
    
    // CLOSING THE POST MODAL
    postModal.addEventListener('click', e => {
      // CHECK IF OUTER PORTON OF MODAL IS CLICKED OR `path` OR `svg` FOR THE `x` ICON ARE CLICKED
      if (e.path[0].classList[0] === 'post-modal-outer' || e.path[2].classList[0] === 'post-modal-close' || e.path[1].classList[0] === 'post-modal-close') {
        // ENABLE SCROLLING
        body.style.height   = 'auto';
        body.style.overflow = 'auto';
        
        // HIDE `postModal`
        postModal.style.display = 'none';
      }
    });
    
    // MAKING CALL TO SUBMIT NEW POST
    submitPostBtn.addEventListener('click', e => {
      e.preventDefault();
      
      ajaxRequests.submitPost('http://localhost/mouthblog/ajax/submit_post.ajax.php',
        `id=${submitPostID.value}&name=${submitPostName.value}&content=${submitPostContent.value}`)
      .then(() => {
        ajaxRequests.returnNewestPost('http://localhost/mouthblog/api/newest_post.php')
          .then(data => {
            const newPost = document.createElement('div');
            
            newPost.setAttribute('class', 'row post-container');
            newPost.innerHTML = `
                                <article class="col-10 offset-1" data-toggle="modal" data-target="#exampleModal">
                                  <h2 class="h2">${ data.user_name }</h2>
                                  <small>${ data.date_created }</small>
                                  
                                  <form action="//localhost/mouthblog/blog.php" method="POST">
                                    <button class="btn btn-danger" name="delete_post" type="submit">DELETE</button>
                                    <input id="delete-post-id" name="post_id" type="hidden" value="${ data.id }">
                                    <input id="delete-post-user-id" name="user_id" type="hidden" value="${ data.user_id }">
                                  </form>
                                  
                                  <hr>
                                  <p class="lead">${ data.content }</p>
                                  <hr>
                                  
                                  <form class="blog-post-interactions">
                                    <i class="far fa-comment-alt fa-lg" data-toggle="modal" data-target="#exampleModal"></i>
                                    <small class="mr-3">${ data.comment_count }</small>
                                    <button class="heart-post-button" type="submit" name="heart_post_button"><i class="fas fa-heart fa-lg"></i></button>
                                    <small>${ data.heart_count }</small>
                                    <input name="heart_count" type="hidden" value="${ data.heart_count }">
                                    <input name="post_id" type="hidden" value="${ data.id }">
                                    <input name="user_id" type="hidden" value="${ data.user_id }">
                                  </form>
                                  
                                </article>
            `;
            
            displayPostWrapper.prepend(newPost);
          }); // then
      }); // then
    }); // click event
    
    // SUBMIT NEW COMMENT
    submitCommentBtn.addEventListener('click', e => {
      e.preventDefault();
      
      const postID          = document.querySelector('.post-modal-post-id').value;
      const commentUserID   = document.querySelector('.post-modal-comment-user-id').value;
      const commentUsername = document.querySelector('.post-modal-comment-username').value;
      const commentContent  = document.querySelector('.post-modal-comment-content').value;
      
      ajaxRequests.submitComment('//localhost/mouthblog/ajax/submit_comment.ajax.php',
        `post_id=${ postID }&user_id=${ commentUserID }&username=${ commentUsername }&comment_content=${ commentContent }`)
        .then(() => {
          const nonModalPostForm = document.querySelectorAll('.blog-post-interactions');
          
          for (let i = 0; i < nonModalPostForm.length; i++) {
            if (nonModalPostForm[i].children[5].value === postID) {
              const commentCountText = nonModalPostForm[i].children[1];
              let commentCountNum = Number(commentCountText.innerText);
              
              commentCountNum++;
              
              commentCountText.innerText = commentCountNum;
            }
          }
          
          ajaxRequests.returnNewestComment('//localhost/mouthblog/api/newest_comment.php')
            .then(data => {
              
              const modalCommentsWrapper = document.querySelector('.post-modal-comments-wrapper');
              const newComment = document.createElement('div');
              
              newComment.setAttribute('class', 'post-modal-comment mb-4');
              newComment.innerHTML = `
                                      <div class="post-modal-comment-header mb-2">
                                        <p class="mb-0">${ data.username }</p>
                                        <small>${ data.date_created }</small>
                                      </div>
                                      <div class="post-modal-comment-content">
                                        <p>${ data.comment_content }</p>
                                      </div>
              `;
              
              modalCommentsWrapper.prepend(newComment);
            }); // then
        }); // then
    }); // click
    
    
  } // if
});
