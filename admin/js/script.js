document.addEventListener('DOMContentLoaded', () => {
    // Fetch and display employees
    fetch('fetch_employees.php')
        .then(response => response.json())
        .then(data => {
            const employeeCards = document.getElementById('employee-cards');
            data.forEach(employee => createEmployeeCard(employee, employeeCards));
        });

    // Search functionality
    document.getElementById('search').addEventListener('input', function() {
        const query = this.value.toLowerCase();
        fetch('fetch_employees.php')
            .then(response => response.json())
            .then(data => {
                const employeeCards = document.getElementById('employee-cards');
                employeeCards.innerHTML = '';
                const filteredEmployees = data.filter(employee => 
                    employee.first_name.toLowerCase().includes(query) || 
                    employee.last_name.toLowerCase().includes(query) ||
                    employee.email.toLowerCase().includes(query) ||
                    employee.phone.toLowerCase().includes(query) ||
                    employee.department.toLowerCase().includes(query) ||
                    employee.position.toLowerCase().includes(query)
                );
                filteredEmployees.forEach(employee => createEmployeeCard(employee, employeeCards));
            });
    });

    // Modal interactions
    const addEmployeeBtn = document.getElementById('add-employee-btn');
    const addEmployeeModal = document.getElementById('add-employee-modal');
    const closeAddEmployeeModalBtn = document.getElementById('close-add-employee-modal');
    const closeModalBtns = document.querySelectorAll('#close-modal, #close-profile-modal');

    addEmployeeBtn.addEventListener('click', () => {
        addEmployeeModal.classList.remove('hidden');
    });

    closeAddEmployeeModalBtn.addEventListener('click', () => {
        addEmployeeModal.classList.add('hidden');
    });

    closeModalBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            addEmployeeModal.classList.add('hidden');
            document.getElementById('view-profile-modal').classList.add('hidden');
        });
    });

    window.addEventListener('click', (event) => {
        if (event.target == addEmployeeModal) {
            addEmployeeModal.classList.add('hidden');
        }
    });

    // Form submission for adding an employee
    document.getElementById('create-employee-form').addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(this);

        fetch('create.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(result => {
            if (result.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: result.message,
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    addEmployeeModal.classList.add('hidden');
                    location.reload();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: result.message,
                });
            }
        });
    });
});

function createEmployeeCard(employee, employeeCards) {
    const card = document.createElement('div');
    card.classList.add('bg-white', 'p-6', 'rounded-lg', 'shadow-md', 'card-animate', 'flex', 'flex-col', 'items-center', 'space-y-3');

    const profileImage = document.createElement('img');
    profileImage.src = '../uploads/' + employee.profile_image; // Adjust the path based on your actual setup
    profileImage.alt = employee.first_name + ' ' + employee.last_name;
    profileImage.classList.add('w-24', 'h-24', 'rounded-full', 'object-cover');

    const name = document.createElement('h2');
    name.textContent = employee.first_name + ' ' + employee.last_name;
    name.classList.add('text-xl', 'font-semibold', 'text-gray-800');

    const email = document.createElement('p');
    email.innerHTML = '<i class="fas fa-envelope text-blue-600"></i> ' + employee.email;
    email.classList.add('text-gray-600');

    const phone = document.createElement('p');
    phone.innerHTML = '<i class="fas fa-phone text-blue-600"></i> ' + employee.phone;
    phone.classList.add('text-gray-600');

    const department = document.createElement('p');
    department.innerHTML = '<i class="fas fa-building text-blue-600"></i> ' + employee.department;
    department.classList.add('text-gray-600');

    const position = document.createElement('p');
    position.innerHTML = '<i class="fas fa-briefcase text-blue-600"></i> ' + employee.position;
    position.classList.add('text-gray-600');


    const bloodGroup = document.createElement("p");
    bloodGroup.innerHTML =
      '<i class="fas fa-tint text-red-600"></i> ' +
      (employee.blood_group || "N/A");
    bloodGroup.classList.add("text-gray-600");

    const emergencyContact = document.createElement("p");
    emergencyContact.innerHTML =
      '<i class="fas fa-phone-alt text-red-600"></i> ' +
      (employee.emergency_contact || "N/A");
    emergencyContact.classList.add("text-gray-600");

    const validityUntil = document.createElement("p");
    validityUntil.innerHTML =
      '<i class="fas fa-calendar-alt text-blue-600"></i> Validity: ' +
      (employee.validity_until || "N/A");
    validityUntil.classList.add("text-gray-600");

    const viewButton = document.createElement('button');
    viewButton.textContent = 'View Profile';
    viewButton.classList.add('px-4', 'py-2', 'mt-4', 'text-white', 'bg-green-600', 'rounded-md', 'hover:bg-green-700', 'focus:outline-none', 'focus:ring-2', 'focus:ring-green-600', 'focus:ring-opacity-50', 'button-animate');
    viewButton.addEventListener('click', () => openViewProfileModal(employee));

    const editButton = document.createElement('button');
    editButton.textContent = 'Edit';
    editButton.classList.add('px-4', 'py-2', 'mt-4', 'text-white', 'bg-blue-600', 'rounded-md', 'hover:bg-blue-700', 'focus:outline-none', 'focus:ring-2', 'focus:ring-blue-600', 'focus:ring-opacity-50', 'button-animate');
    editButton.addEventListener('click', () => openEditModal(employee));

    const deleteButton = document.createElement('button');
    deleteButton.textContent = 'Delete';
    deleteButton.classList.add('px-4', 'py-2', 'mt-4', 'text-white', 'bg-red-600', 'rounded-md', 'hover:bg-red-700', 'focus:outline-none', 'focus:ring-2', 'focus:ring-red-600', 'focus:ring-opacity-50', 'button-animate');
    deleteButton.addEventListener('click', () => deleteEmployee(employee.id, card));

    const buttonContainer = document.createElement('div');
    buttonContainer.classList.add('flex', 'space-x-2');
    buttonContainer.appendChild(viewButton);
    buttonContainer.appendChild(editButton);
    buttonContainer.appendChild(deleteButton);

    card.appendChild(profileImage);
    card.appendChild(name);
    card.appendChild(email);
    card.appendChild(phone);
    card.appendChild(department);
    card.appendChild(position);
    card.appendChild(bloodGroup);
    card.appendChild(emergencyContact);
    card.appendChild(validityUntil);
    card.appendChild(buttonContainer);

    employeeCards.appendChild(card);
}

function openViewProfileModal(employee) {
    const modal = document.getElementById('view-profile-modal');
    const profileContent = document.getElementById('profile-content');
    profileContent.innerHTML = '';

    const profileImage = document.createElement('img');
    profileImage.src = '../uploads' + employee.profile_image;
    profileImage.alt = employee.first_name + ' ' + employee.last_name;
    profileImage.classList.add('w-24', 'h-24', 'rounded-full', 'object-cover');

    const name = document.createElement('h2');
    name.textContent = employee.first_name + ' ' + employee.last_name;
    name.classList.add('text-xl', 'font-semibold', 'text-gray-800');

    const email = document.createElement('p');
    email.innerHTML = '<i class="fas fa-envelope text-blue-600"></i> ' + employee.email;
    email.classList.add('text-gray-600');

    const phone = document.createElement('p');
    phone.innerHTML = '<i class="fas fa-phone text-blue-600"></i> ' + employee.phone;
    phone.classList.add('text-gray-600');

    const department = document.createElement('p');
    department.innerHTML = '<i class="fas fa-building text-blue-600"></i> ' + employee.department;
    department.classList.add('text-gray-600');

    const position = document.createElement('p');
    position.innerHTML = '<i class="fas fa-briefcase text-blue-600"></i> ' + employee.position;
    position.classList.add('text-gray-600');


    
    const profileURL = document.getElementById('profile-url');
    profileURL.value = window.location.origin + '/setwaysemp/public/view_profile.php?id=' + employee.id;

    profileContent.appendChild(profileImage);
    profileContent.appendChild(name);
    profileContent.appendChild(email);
    profileContent.appendChild(phone);
    profileContent.appendChild(department);
    profileContent.appendChild(position);
    profileContent.appendChild(bloodGroup);
    profileContent.appendChild(emergencyContact);
    profileContent.appendChild(validityUntil);

    modal.classList.remove('hidden');
}

document.getElementById('close-profile-modal').addEventListener('click', () => {
    document.getElementById('view-profile-modal').classList.add('hidden');
});

function openEditModal(employee) {
    const modal = document.getElementById('edit-modal');
    document.getElementById('edit-id').value = employee.id;
    document.getElementById('edit-first_name').value = employee.first_name;
    document.getElementById('edit-last_name').value = employee.last_name;
    document.getElementById('edit-email').value = employee.email;
    document.getElementById('edit-phone').value = employee.phone;
    document.getElementById('edit-department').value = employee.department;
    document.getElementById('edit-position').value = employee.position;

    modal.classList.remove('hidden');
}

document.getElementById('close-modal').addEventListener('click', () => {
    const modal = document.getElementById('edit-modal');
    modal.classList.add('hidden');
});

document.getElementById('edit-form').addEventListener('submit', function (event) {
    event.preventDefault();
    const id = document.getElementById('edit-id').value;
    const formData = new FormData(this);
    formData.append('id', id);

    fetch('update_employees.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(result => {
        if (result === 'success') {
            location.reload();
        } else {
            alert('Failed to update employee.');
        }
    });
});

function deleteEmployee(id, card) {
  fetch("delete_employees.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: `id=${encodeURIComponent(id)}`,
  })
    .then((response) => response.json())
    .then((result) => {
      if (result.status === "success") {
        card.remove();
      }
    })
    .catch((error) => {
      Swal.fire({
        icon: "error",
        title: "Error",
        text: "Something went wrong. Please try again later.",
        showConfirmButton: true,
      });
    });
}
