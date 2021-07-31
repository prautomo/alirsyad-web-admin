
import React, { useEffect, useState } from 'react'
import ReactDOM from 'react-dom'
import { object } from 'yup/lib/locale';
import classNames from 'classnames'
const roles = {
    "CUSTOMER": "Pelanggan",
    "MITRA": "Mitra",
}
function RolePicker({ selected }) {
    const [selectedJenis, setSelectedJenis] = useState("CUSTOMER");
    useEffect(() => {
        setSelectedJenis(selected)
    }, [selected]);
    useEffect(() => {
        if (selectedJenis === "CUSTOMER") {
            document.getElementById("nama_toko").textContent = ("Nama Lengkap ");
        } else
            if (selectedJenis === "MITRA") {
                document.getElementById("nama_toko").textContent = ("Nama Toko ");
            }
    }, [selectedJenis]);
    return (<>

        <div className="d-flex flex-row">
            {Object.keys(roles).map((item) => {
                return <button onClick={(e) => {
                    e.preventDefault()
                    setSelectedJenis(item)
                }} className={classNames("btn w-50", { "btn-danger": item == selectedJenis })}>
                    {roles[item]}
                </button>
            })}

            <input type="hidden" name="user_type" value={selectedJenis} />

        </div>

    </>)
}


export default RolePicker;
// jenis_akun


if (document.getElementById('jenis_akun')) {

    var container = document.getElementById("jenis_akun")
    var selected = container.getAttribute("selected")
    ReactDOM.render(<RolePicker selected={selected ? selected : "CUSTOMER"} />, container);
}






