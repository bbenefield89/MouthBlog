define(() => {
  class AJAXRequests {
    constructor() {
      this.xhr = new XMLHttpRequest();
    }
    
    // FIGURE THIS OUT
    xhrMethods(method, url, sendData = {} ) {}
    
    // RETURN ALL POSTS
    getAllPosts() {
      return new Promise((resolve, reject) => {
        this.xhr.open('GET', '//localhost/mouthblog/api/blog.php', true);
        this.xhr.send();
        
        this.xhr.onload = () => {
          if (this.xhr.status == 200) {
            resolve(JSON.parse(this.xhr.response));
          } else {
            reject(this.xhr.statusText);
          }
        };
        
        this.xhr.onerror = () => {
          reject(this.xhr.statusText);
        };
      });
    }
    
    // DELETE POST
    deletePostPromise(url, postID) {
      return new Promise((resolve, reject) => {
        this.xhr.open('POST', url, true);
        this.xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        this.xhr.send(postID);
        
        this.xhr.onload = () => {
          if (this.xhr.status == 200) {
            resolve();
          } else {
            reject(this.xhr.statusText);
          }
        };
        
        this.xhr.onerror = () => {
          reject(this.xhr.statusText);
        };
      });
    }
    
    // SUBMIT NEW POST
    submitPost(url, formData) {
      return new Promise((resolve, reject) => {
        this.xhr.open('POST', url, true);
        
        this.xhr.onload = () => {
          if (this.xhr.status == 200) {
            resolve();
          } else {
            reject(this.xhr.statusText);
          }
        };
        
        this.xhr.onerror = () => {
          reject(this.xhr.statusText);
        };
        
        this.xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        this.xhr.send(formData);
      });
    }
    
    // RETURN NEWEST POST
    returnNewestPost(url) {
      return new Promise((resolve, reject) => {
        // const xhr = new XMLHttpRequest();
        
        this.xhr.open('GET', url, true);
        
        this.xhr.onload = () => {
          if (this.xhr.status == 200) {
            resolve(JSON.parse(this.xhr.response));
          } else {
            reject(this.xhr.statusText);
          }
        };
        
        this.xhr.onerror = () => {
          reject(this.xhr.statusText);
        };
        
        this.xhr.send();
      });
    }
    
    // HEART A POST
    heartPost(url, formData) {
      return new Promise((resolve, reject) => {
        this.xhr.open('POST', url, true);
        this.xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        this.xhr.send(formData);
        
        this.xhr.onload = () => {
          if (this.xhr.status == 200) {
            resolve();
          } else {
            reject(this.xhr.statusText);
          }
        };
        
        this.xhr.onerror = () => {
          reject(this.xhr.statusText);
        };
      });
    }
    
    // UNHEART A POST
    unHeartPost(url, formData) {
      return new Promise((resolve, reject) => {
        this.xhr.open('POST', url, true);
        this.xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        this.xhr.send(formData);
        
        this.xhr.onload = () => {
          if (this.xhr.status == 200) {
            resolve();
          } else {
            reject(this.xhr.statusText);
          }
        };
        
        this.xhr.onerror = () => {
          reject(this.xhr.statusText);
        };
      });
    }
    
    submitComment(url, formData) {
      return new Promise((resolve, reject) => {
        this.xhr.open('POST', url, true);
        this.xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        this.xhr.send(formData);
        
        this.xhr.onload = () => {
          if (this.xhr.status == 200) {
            resolve();
          } else {
              reject(this.xhr.statusText);
          }
        };
        
        this.xhr.onerror = () => {
          reject(this.xhr.statusText);
        };
      });
    }
    
    returnNewestComment(url) {
      return new Promise((resolve, reject) => {
        this.xhr.open('GET', url, true);
        this.xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        this.xhr.send();
        
        this.xhr.onload = () => {
          if (this.xhr.status == 200) {
            resolve(JSON.parse(this.xhr.response));
          } else {
            reject(this.xhr.statusText);
          }
        };
        
        this.xhr.onerror = () => {
          reject(this.xhr.statusText);
        };
      });
    }
    
    returnCurrentPostComments(data) {
      return new Promise((resolve, reject) => {
        this.xhr.open('POST', '//localhost/mouthblog/api/comments.php', true);
        this.xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        this.xhr.send(data);
        
        this.xhr.onload = () => {
          if (this.xhr.status == 200) {
            resolve(JSON.parse(this.xhr.response));
          } else {
            reject(this.xhr.statusText);
          }
        };
        
        this.xhr.onerror = () => {
          reject(this.xhr.statusText);
        };
      });
    }
  }
  
  // RETURNING `AJAXRequests` CLASS AS `AJAXRequest`
  return { AJAXRequests: AJAXRequests };
});
