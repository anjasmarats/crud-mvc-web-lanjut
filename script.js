const setDelete = (data) => {
    document.getElementsByClassName("modal-title")[0].innerHTML = "Hapus Proyek"
    const id = data.classList
    const input = document.getElementById("id_proyek")
    const form = document.getElementById("form-proyek")
    const body_confirm = document.getElementsByClassName("body-confirm")[0]
    const confirm = document.querySelector(".body-confirm .confirm")
    const nama_proyek = id[4].replaceAll("_"," ")
    const button = document.querySelector(".modal-footer button")
    button.classList.add("btn-danger")
    button.classList.remove("btn-primary")
    button.innerHTML = "Hapus"

    console.log(id)
    console.log(nama_proyek)

    confirm.innerHTML = nama_proyek
    body_confirm.classList.remove("d-none")
    body_confirm.classList.add("d-block")

    form.classList.add("d-none")
    form.classList.remove("d-block")

    input.setAttribute("name","id_proyek_delete")
    input.setAttribute("value",id[3][3])
}

const setUpdate = (data) => {
    if (!data) {
        return
    }
    document.getElementsByClassName("modal-title")[0].innerHTML = "Edit Proyek"
    const proyek_data = document.getElementsByClassName(`d-none ${data}`)[0]
    console.log(proyek_data)
    const object = JSON.parse(proyek_data.innerHTML)
    const id = proyek_data.classList[2][3]
    const nama_proyek = object.nama_proyek
    const jenis_proyek = object.jenis_proyek
    const nama_proyek_input = document.getElementsByClassName("nama_proyek")[0]
    const jenis_proyek_input = document.getElementsByClassName("jenis_proyek")[0]
    const input = document.getElementById("id_proyek")
    const form = document.getElementById("form-proyek")
    const body_confirm = document.getElementsByClassName("body-confirm")[0]

    const button = document.querySelector(".modal-footer button")
    button.classList.add("btn-primary")
    button.classList.remove("btn-danger")
    button.innerHTML = "Simpan"

    // console.log(proyek)
    nama_proyek_input.setAttribute("value",nama_proyek)
    jenis_proyek_input.value = jenis_proyek

    // confirm.innerHTML = nama_proyek
    body_confirm.classList.add("d-none")
    body_confirm.classList.remove("d-block")

    form.classList.remove("d-none")
    form.classList.add("d-block")

    input.setAttribute("name","id_proyek")
    input.setAttribute("value",id)
}