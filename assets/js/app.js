// app.js

// Logout button confirmation
document.addEventListener('DOMContentLoaded', function () {
  const logoutBtn = document.getElementById('logoutBtn');
  if (logoutBtn) {
      logoutBtn.addEventListener('click', function () {
          Swal.fire({
              title: 'Are you sure?',
              text: "Do you really want to log out?",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonText: 'Yes, log me out!',
              cancelButtonText: 'Cancel'
          }).then((result) => {
              if (result.isConfirmed) {
                  window.location.href = '../logout.php';
              }
          });
      });
  }

  const select = document.getElementById('room_id');
  const guestsInput = document.getElementById('guests');
  const capacityInfo = document.getElementById('capacity_info');

  function updateCapacity() {
      if (select && guestsInput && capacityInfo) {
          const selectedOption = select.options[select.selectedIndex];
          const maxCapacity = selectedOption.getAttribute('data-capacity');

          guestsInput.max = maxCapacity;
          capacityInfo.innerText = `Max ${maxCapacity} guests allowed`;
      }
  }

  if (select) {
      select.addEventListener('change', updateCapacity);
      updateCapacity(); 
  }


});

