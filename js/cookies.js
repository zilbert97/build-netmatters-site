function checkAcceptCookies () {
  /**
   * Checks and if required prompts user to accept cookies.
   *
   * Checks if the user has accepted cookies, and if not accepted
   * opens a modal prompting the user to accept. If the user accepts,
   * this information is stored in localStorage, the the modal is closed.
   *
   * @return {void} Nothing
   */


   function showHideModal(modal, display = 'none') {
     /**
      *
      *
      */

     if (display === 'hide') {
       // Hide the modal
       modal.style.display = 'none';
       // Re-enable scrolling the background
       document.body.style.overflow = 'visible';
     } else {
       // Show the modal (set the display property to value passed)
       modal.style.display = display;
       // Prevent scrolling the document body
       document.body.style.overflow = 'hidden';
     }
   }


  const modal = document.getElementById('modal');

  const acceptedCookies = localStorage.getItem('acceptedCookies');

  // Check if key exists and value is 'true'
  if (acceptedCookies !== 'true') {
    // If does not exist or is not 'true', prompt user via modal.
    // Parameters prevent closing unless user selects an option.
    showHideModal(modal, 'block');

    const buttons = document.getElementsByClassName('modal-button');

    // Add click event listeners to each button to close the modal
    for (let i = 0; i < buttons.length; i++) {
      buttons[i].addEventListener('click', () => {
        showHideModal(modal, 'none');

        // On user click accept, set value in localStorage so that the user
        // is not be re-prompted while navigating the site.
        if (buttons[i].id === 'modal-content-button-accept') {
          localStorage.setItem('acceptedCookies', 'true');
        }
      });
    }
  }
}
