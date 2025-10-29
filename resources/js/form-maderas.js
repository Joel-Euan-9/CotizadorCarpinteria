let btnAgregarMadera= document.getElementById('btn-agregar-madera')
let contForm= document.getElementById('form-cont')
let btnEliminarMadera= document.getElementById('btn-eliminar-madera')

function agregar(){
    let div = document.createElement('div')
    div.classList.add('row')
    let contenido = `
    <div class="row mb-2">
                <div class="col-12">
                    
                    <select name="" id="" class="form-select w-25">
                        <option value="" disabled select>Selecciona el tipo de madera</option>
                        <option value="" >Pino</option>
                        <option value="" >Encino</option>
                        <option value="" >Cedro</option>
                        <option value="" >Poplar</option>
                        <option value="" >Parota</option>
                    </select>
                </div>
                <div class="col-auto">
                    <label for="pieza" class="form-label">Pieza</label>
                    <input type="text" name="pieza" id="" placeholder="Fondo" class="form-control col-auto">
                </div>
                <div class="col-auto">

                    <label for="pieza" class="form-label">Largo</label>
                    <input type="text" name="pieza" id="" class="form-control col-auto">
                </div>
                <div class="col-auto">

                    <label for="pieza" class="form-label">Ancho</label>
                    <input type="text" name="pieza" id="" class="form-control col-auto">
                </div>
                <div class="col-auto">

                    <label for="pieza" class="form-label">Cantidad</label>
                    <input type="text" name="pieza" id="" class="form-control col-auto">
                </div>
                <div class="col-auto ms-auto">
                    <button class="btn btn-outline-danger">Eliminar</button>
                </div>
            </div>
    `
    div.innerHTML = contenido
    contForm.appendChild(div)
    console.log("adaa")
}

function eliminar(){

}

btnAgregarMadera.addEventListener('click', agregar)