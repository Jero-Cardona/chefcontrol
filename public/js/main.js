const openModal = document.querySelector('.mostrarReceta')
const modal = document.querySelector('.modal')
const closeModal = document.querySelector('.cerrarModal');

openModal.addEventListener('click', (e)=>{
  e.preventDefault();
  modal.classList.add('.modal--show');
});

closeModal.addEventListener('click', (e)=>{
  e.preventDefault();
  modal.classList.remove('.modal--show');
});