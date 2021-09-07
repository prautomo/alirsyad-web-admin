import React, { useState } from 'react'
import Select from 'react-select';
import useFetch from '../../../../store/useFetch';

function ModulPicker({selectedItem, setSelectedItem}) {

    var { data, isLoading, isError } = useFetch("/backoffice/story-paths/moduls")
    
    return (<>

        {isLoading ? 
            <Select
                isDisabled={true}
            />
        :
            <>
                <Select
                    placeholder={"Pilih Modul"}
                    value={selectedItem}
                    options={data}
                    onChange={(value) => setSelectedItem(value)}
                />
            </>
        }

    </>)
}

export default ModulPicker;