function submitForm(event) {
  event.preventDefault();

  const email = document.getElementById("email").value;
  const name = document.getElementById("name").value;
  const image = document.getElementById("image").files[0];
  const terms = document.getElementById("terms").checked;

  if (!terms && !image) {
    return;
  }

  const formData = new FormData();
  formData.append("email", email);
  formData.append("name", name);
  formData.append("image", image);

  fetch("process_form.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => {
      if (response.ok) {
        alert("Form submitted successfully!");
      } else {
        alert("Bad request - unable to submit the form.");
      }
    })
    .catch((error) => {
      console.error("An error occurred:", error);
    });
}

function fetchDataAndDisplay() {
  const dataContainer = document.getElementById("data-container");
  console.log("test before fetch");
  fetch("/get_table_data.php")
    .then((response) => {
      if (!response.ok) {
        // throw new Error("Network response was not ok");
      }
      return response.json();
    })
    .then((data) => {
      dataContainer.innerHTML = createHTMLFromData(data);
    })
    .catch((error) => {
      console.error("Error:", error);
      dataContainer.innerHTML = "Failed to fetch data.";
    });
}

function createHTMLFromData(data) {
  let html = "<ul>";
  data.forEach((item) => {
    html += "<li>";
    html += `<img src="/uploads/${item.image_path}" alt="Image">`;
    html += `<div>Name: ${item.name}</div>`;
    html += `<div>Email: ${item.email}</div>`;
    html += "</li>";
  });
  html += "</ul>";
  return html;
}
