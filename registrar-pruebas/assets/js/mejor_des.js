import app from "./api.js";

const d = document;
let data_estadisticas;

const extract_statistic = async (form_data) => {
    try {
        data_estadisticas = await app('http://192.168.0.164/registrar-pruebas/controllers/general_statistic.php?extract_statistic=1','POST',form_data);
        console.log(data_estadisticas)
      } catch (error) {
        console.log(error);
      }
};

// Función para formatear la fecha
const formatDate = (date) => {
  const year = date.getFullYear();
  const month = String(date.getMonth() + 1).padStart(2, '0'); // Meses son 0-11
  const day = String(date.getDate()).padStart(2, '0');
  const hours = String(date.getHours()).padStart(2, '0');
  const minutes = String(date.getMinutes()).padStart(2, '0');
  const seconds = String(date.getSeconds()).padStart(2, '0');
  
  return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
};

//Capturamos el evento submit y ejecutamos logica para realizar peticiones a backend
d.addEventListener("submit", e => {
    e.preventDefault();

    const start_date = e.target.start_date.value;
    const final_date = e.target.final_date.value;
    const h = new Date()   
    if(start_date.length === 0){
      alert('Por favor ingresar fecha inicial');
      return;
    }
  
    if(final_date.length === 0){
      alert('Por favor ingresar fecha final');
      return;
    }

    // Convertimos las fechas a objetos Date
    const startDateObj = new Date(start_date);
    const finalDateObj = new Date(final_date);

    //Validamos que el periodo seleccionado sea correcto
    if (isNaN(startDateObj.getTime()) || isNaN(finalDateObj.getTime())) {
        alert('Por favor ingresar fechas validas');
        return;
    }

    if (startDateObj > finalDateObj) {
        alert('La fecha de inicio debe ser anterior a la fecha final.');
        return;
    }

    // Creamos formdata
    const formData = new FormData();
    formData.append('start_date', formatDate(startDateObj)); // Formato deseado
    formData.append('final_date', formatDate(finalDateObj)); 

    //Ejecutamos consultas
    extract_statistic(formData);
});


