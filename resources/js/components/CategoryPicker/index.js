import { range } from 'lodash';
import React, { useState } from 'react'
import ReactDOM from 'react-dom'
import useFetch from '../../store/useFetch';



function HeaderCategory({ }) {

    const [selectedItems, setSelectedItems] = useState(null);

    var { data, isLoading, isError } = useFetch("/app/data/getcategory")
    return (<>

        {isLoading ? "LOADING" :
            <>

                <div className="d-flex flex-row align-items-top justify-items-between category_container mb-4"  >
                    {
                        data.map((item) => {
                            return <CategoryItemRender key={item?.id} item={item} setSelectedItems={setSelectedItems} selectedItems={selectedItems}></CategoryItemRender>
                        })}
                </div>
                <div className="d-flex container" style={{ marginLeft: "0px" }}>

                    {selectedItems == null ? "" : <RenderCategoryDetail item={selectedItems}></RenderCategoryDetail>}
                </div>
            </>
        }

    </>)
}

function CategoryItemRender({ item, setSelectedItems, selectedItems }) {

    return (<>


        <div className="category_item_container" onMouseEnter={() => {
            setSelectedItems(item)
        }} style={{ borderBottom: (item.id == (selectedItems ? selectedItems.id : "")) ? "2px red solid" : "0px" }}>
            <div className="d-flex flex-column align-items-center p-1 m-1" style={{ width: '100px', textAlign: 'center', cursor: 'pointer' }}>
                <img src={item.icon} width="50px" className="img-fluid" alt="" />
                <span className="font-medium pt-2" style={{ textAlign: 'center', color: "red" }}>{item.name}</span>
            </div>
        </div>

    </>)
}

function RenderCategoryDetail({ item }) {
    var perPage = 5
    function createQs(params) {

        return Object.keys(params).map(function (key) {
            return key + '=' + params[key]
        }).join('&');

    }
    return (<>


        <div className="row">

            <div className="col-lg-12 pb-2">
                <b>
                    {item.name}
                </b>
            </div>
            {range(0, 2).map((page) => {

                return <div className="col-md-5">

                    {item.sub.slice(page * perPage, (page * perPage) + perPage).map((subItem) => {

                        return <div className="d-flex flex-column pb-2 subcategoryitem" style={{ width: '120px', textAlign: 'center' }}>
                            <a href={"/product?" + createQs({ category: item.slug, subcategory: subItem.slug })} style={{ textAlign: 'start' }}>{subItem.name}</a>
                        </div>
                    })}

                </div>
            })}
        </div>
    </>)
}


export default HeaderCategory;

if (document.getElementById('header_cateogory')) {

    ReactDOM.render(<HeaderCategory />, document.getElementById('header_cateogory'));
}

