function updateCapacity() {
    const select = document.getElementById('room_id');
    const guestsInput = document.getElementById('guests');
    const selectedOption = select.options[select.selectedIndex];
    const maxCapacity = selectedOption.getAttribute('data-capacity');
  
    guestsInput.max = maxCapacity;
    document.getElementById('capacity_info').innerText = `Max ${maxCapacity} guests allowed`;
  }
  
  document.addEventListener("DOMContentLoaded", updateCapacity);