/* 
Projeto Cadastro de carros PHP
*/

// Listen for click event on the element
document.getElementById('openModalButton').addEventListener('click', function () {
  // Show the modal using Bootstrap's modal method
  const myModal = new bootstrap.Modal(document.getElementById('modalCadastro'))
  myModal.show()
})

// deleteCar
$(document).ready(function () {
  // Click event handler for the delete car button
  $('.delete-car').click(function () {
    const carId = $(this).closest('div').find('.edit-car').data('car-id')

    // Retrieve the car ID
    // const carId = $(this).find('.edit-car').data('car-id')

    // Prompt for confirmation
    //const confirmDelete = confirm('Are you sure you want to delete this car?')

    //confirm
    Swal.fire({
      title: 'Confirmar ação irreverssível',
      text: 'Você quer apagar esse carro do registro?',
      icon: 'warning',
      showCancelButton: true,
      cancelButtonText: 'Cancelar',
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sim, apagar!',
    }).then((result) => {
      // confirmar fazer ajax
      if (result.isConfirmed) {
        $.ajax({
          url: '../controllers/CarController.php',
          type: 'POST',
          data: { action: 'ajaxDelete', id: carId },
          dataType: 'json',
          success: function (response) {
            // Handle success response
            // If success is true, display a success message or perform any other action
            if (response.success) {
              Swal.fire('Carro apagado com sucesso!')
              reloadpage()
            } else {
              // If success is false, display an error message
              console.error('Error deleting car: ' + response.message)
            }
          },
          error: function (xhr, status, error) {
            // Handle error
            console.error(xhr.responseText)
            console.error('An error occurred while deleting car. Please try again.')
          },
        })
      }
    })
  })
})

// registro
$(document).ready(function () {
  $('#registerCarForm').submit(function (event) {
    event.preventDefault() // Prevent default form submission
    const formData = $(this).serialize() // Serialize form data

    $.ajax({
      url: '../controllers/CarController.php', // URL of your PHP controller
      type: 'POST',
      data: formData + '&action=ajaxRegister', // Include the action parameter
      dataType: 'json',
      success: function (response) {
        // Handle success response here
        if (response.success) {
          // Show success message or perform other actions
          //alert('Car registered successfully!')

          Swal.fire('Carro adicionado com sucesso!!')

          reloadpage()
          // Optionally, you can reload or update the dashboard page here
        } else {
          // Show error message or perform other actions
          alert('Error: ' + response.message)
        }
        $('#exampleModal').modal('hide') // Close the modal
      },
      error: function (xhr, status, error) {
        // Handle error response here
        console.error(xhr.responseText) // Log the error response
        // Optionally, you can display an error message to the user
      },
    })
  })
})

// Function to fetch and populate car details in the edit modal
function populateEditModal(carId) {
  // Make AJAX request to fetch car details
  $.ajax({
    url: '../controllers/CarController.php',
    type: 'POST',
    data: { action: 'ajaxGetCarDetails', id: carId },
    dataType: 'json',
    success: function (response) {
      // Populate edit modal with car details
      $('#edit_car_id').val(carId)
      $('#edit_marca').val(response.marca)
      $('#edit_modelo').val(response.modelo)
      $('#edit_cor').val(response.cor)
      $('#edit_ano').val(response.ano)
      $('#edit_valor').val(response.valor)
      $('#edit_status').val(response.status)
    },
    error: function (xhr, status, error) {
      console.error(xhr.responseText)
      // Handle error
    },
  })
}

// editCarForm
$(document).ready(function () {
  // Submit event handler for the edit car form
  $('#editCarForm').submit(function (event) {
    // Prevent the default form submission
    event.preventDefault()

    // Serialize form data
    const formData = $(this).serialize()

    // Make AJAX request to update car details
    $.ajax({
      url: '../controllers/CarController.php',
      type: 'POST',
      data: formData + '&action=ajaxUpdate', // Add the action parameter
      dataType: 'json',
      success: function (response) {
        // If success is true, display a success message or perform any other action
        if (response.success) {
          $('#editCarModal').modal('hide')
          Swal.fire('Carro atualizado com sucesso!!')
          // atualiza a page
          reloadpage()
        } else {
          // If success is false, display an error message
          console.error('Error updating car details: ' + response.message)
        }
      },
      error: function (xhr, status, error) {
        // Handle error
        console.error(xhr.responseText)
        console.error('An error occurred while updating car details. Please try again.')
      },
    })
  })
})

// Edit car button click event
$('.edit-car').click(function () {
  const carId = $(this).data('car-id') // Get the car ID

  // Show the edit modal
  $('#editCarModal').modal('show')

  // Populate edit modal with car details
  populateEditModal(carId)
})

/* registro datalist */
$(document).ready(function () {
  $('#marca').on('input', function () {
    let selectedMarca = $(this).val()
    console.log(selectedMarca)
    let modelos = []
    // Populate modelos based on selectedMarca
    switch (selectedMarca) {
      case 'Audi':
        modelos = ['AUDI A3', 'AUDI A4', 'AUDI A5', 'AUDI E-TRON GT', 'AUDI Q3', 'AUDI Q5', 'AUDI Q8 E-TRON', 'AUDI RS E-TRON GT']
        break
      case 'BMW':
        modelos = ['BMW 1 Series', 'BMW 2 Series', 'BMW 3 Series', 'BMW 4 Series', 'BMW 5 Series', 'BMW 6 Series', 'BMW 7 Series']
        break
      case 'Chevrolet':
        modelos = ['Chevrolet Camaro', 'Chevrolet Corvette', 'Chevrolet Impala', 'Chevrolet Malibu', 'Chevrolet Silverado', 'Chevrolet Suburban', 'Chevrolet Tahoe']
        break
      case 'Mercedes':
        modelos = ['Mercedes-Benz A-Class', 'Mercedes-Benz B-Class', 'Mercedes-Benz GLA', 'Mercedes-Benz SL', 'Mercedes-Benz AMG GT']
        break
      case 'Honda':
        modelos = ['Honda Accord', 'Honda Civic', 'Honda CR-V', 'Honda Fit', 'Honda HR-V', 'Honda Pilot', 'Honda Ridgeline']
        break
      // Add cases for other marcas
      default:
        modelos = []
    }
    // Populate the datalist with modelos
    $('#modeloList').empty()

    $.each(modelos, function (index, value) {
      $('#modeloList').append('<option value="' + value + '">')
    })
  })
})

// Reload the page to reflect the changes no DOM
function reloadpage() {
  setTimeout(() => {
    location.reload()
  }, 1000)
}

/* AREA DE TESTES */
document.addEventListener('DOMContentLoaded', function () {
  const myModal = new bootstrap.Modal(document.getElementById('filterModal'))
  const btn = document.getElementById('btnFilter')

  btn.onclick = function () {}
})

// novo filter by javascript
const carsTitles = document.querySelectorAll('.car')
const myModal2 = new bootstrap.Modal(document.getElementById('searchModalLabel'))
const filterFormFilter2 = document.querySelector('#filterFormFilter2')
const notfound = document.querySelector('#notfound')

// cleanFilter, volta a class original nesse caso flex
const cleanFilter = document.querySelector('#cleanFilter')
// state desse button is hide
cleanFilter.style.display = 'none'

filterFormFilter2.onsubmit = function (e) {
  e.preventDefault()

  // voltar a mostrar todas antes de passar pelo filtro novamente
  cleanFilterHandler()

  const fdata = new FormData(filterFormFilter2)
  const obj = Object.fromEntries(fdata)

  for (let card of carsTitles) {
    const marca = card.querySelector('.car-details .marca').textContent.toLowerCase()
    const modelo = card.querySelector('.car-details .modelo').textContent.toLocaleLowerCase()
    const corcarro = card.querySelector('.car-details .corcarro').textContent.toLocaleLowerCase()
    const anocarro = card.querySelector('.car-details .anocarro').textContent.toLocaleLowerCase()
    const statuscarro = card.querySelector('.car-details .statuscarro').textContent.toLocaleLowerCase()

    if (!marca.includes(obj.marca.toLowerCase())) {
      card.style.display = 'none'
    }
    if (!modelo.includes(obj.modelo.toLowerCase())) {
      card.style.display = 'none'
    }
    if (!corcarro.includes(obj.cor.toLowerCase())) {
      card.style.display = 'none'
    }
    if (!anocarro.includes(obj.ano.toLowerCase())) {
      card.style.display = 'none'
    }

    if (!statuscarro.startsWith(obj.status.toLowerCase())) {
      card.style.display = 'none'
    }
  }
  /* nao nao exiba nenhum, 404 handler */
  if (Array.from(carsTitles).every((val) => val.style.display === 'none')) {
    notfound.style.display = 'block'
    notfound.textContent = 'Nenhum resultado encontrado'
  }

  // hide o modal depois do submit
  myModal2.hide()

  // show btn filter
  cleanFilter.style.display = 'inline'
}

cleanFilter.onclick = cleanFilterHandler

function cleanFilterHandler() {
  for (let cards of carsTitles) {
    //cards.style.display = ''
    cards.removeAttribute('style')
  }

  //hide button again
  cleanFilter.style.display = 'none'
  notfound.style.display = 'none'
}
