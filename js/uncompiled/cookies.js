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


   function showHideModal(modal, show = 'show') {
    /**
     * Shows or hides the modal, and toggles the body scrolling.
     *
     * @param {element} modal - the element to show/hide as a modal.
     * @param {string} show   - whether to show/hide the modal. 'hide' sets
     *                          modal display to 'none'; 'show' sets display
     *                          'block' and prevents background scrolling.
     */

    if (show === 'hide') {
      // Hide the modal
      modal.style.display = 'none';
      // Re-enable scrolling the body
      document.body.style.overflow = 'visible';
    } else if (show === 'show') {
      // Show the modal
      modal.style.display = 'block';
      // Scroll the modal
      modal.style.overflow = 'auto';
      // Prevent scrolling the document body
      document.body.style.overflow = 'hidden';
    }
  }

  const modal = document.getElementById('modal');
  // const acceptedCookies = localStorage.getItem('acceptedCookies');

  // Check if key exists and value is 'true'
  if (!document.cookie.split('; ').find(row => row.startsWith('acceptedCookies'))) { // if (acceptedCookies !== 'true') {
    // If does not exist or is not 'true', prompt user via modal.
    // Parameters prevent closing unless user selects an option.
    showHideModal(modal, 'show');

    const buttons = document.getElementsByClassName('modal-button');

    // Add click event listeners to each button to close the modal
    for (let i = 0; i < buttons.length; i++) {
      buttons[i].addEventListener('click', function() {
        showHideModal(modal, 'hide');

        // On user click accept, set value in localStorage so that the user
        // is not be re-prompted while navigating the site.
        if (buttons[i].id === 'modal-content-button-accept') {
          document.cookie = 'acceptedCookies=true';  // localStorage.setItem('acceptedCookies', 'true');
        }

        // Fix bug where closing modal causes adjustment of carousel image -
        // reset width of each slide to 100%
        $('.slide').css('width', '100%');
      });
    }
  }
}
