function toggleAccordion(event, menuId) {
  event.preventDefault();
  const menu = document.getElementById(menuId);
  const isOpen = !menu.classList.contains('hidden');
  hideAllMenus();
  if (!isOpen) {
      menu.classList.remove('hidden');
  }
}

function hideAllMenus() {
  const menus = document.querySelectorAll('.sidebar ul ul');
  menus.forEach(menu => {
      menu.classList.add('hidden');
  });
}

