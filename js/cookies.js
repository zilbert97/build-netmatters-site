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

  const acceptedCookies = localStorage.getItem('acceptedCookies');

  // Check if key exists and value is 'true'
  if (acceptedCookies !== 'true') {
    // If does not exist or is not 'true', prompt user via modal.
    // Key: value pairs prevent closing unless user selects an option.
    $("#modal").modal({
     escapeClose: false,
     clickClose: false,
     showClose: false
    });

    // On user click accept, set value in localStorage so that the user
    // is not be re-prompted while navigating the site.
    const buttonAccept = document.querySelector('#modal-button-accept');

    buttonAccept.addEventListener('click', () => {
      localStorage.setItem('acceptedCookies', 'true');
      $.modal.close();
    });
  }
}
