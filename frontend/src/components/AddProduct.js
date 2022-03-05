import React, { useState } from 'react'
import { useHistory } from 'react-router-dom';
import axios from "axios";
 
const AddProduct = () => {
    const [title, setTitle] = useState('');
    const [price, setPrice] = useState('');
    const history = useHistory();
 
    const saveProduct = async (e) => {
        e.preventDefault();
        await axios.post('http://localhost:8080/products',{
            title: title,
            price: price
        });
        history.push("/");
    }
 
    return (
        <div>
            <form onSubmit={ saveProduct }>
                <div className="field">
                    <label className="label">Name</label>
                    <input 
                        type="text"
                        className="input"
                        value={ name } 
                        onChange={ (e) => setTitle(e.target.value) }
                        placeholder="Name"
                    />
                </div>
                <div className="field">
                    <label className="label">Price</label>
                    <input 
                        type="text"
                        className="input"
                        value={ price } 
                        onChange={ (e) => setPrice(e.target.value) }
                        placeholder="Price"
                    />
                </div>
                <div className="field">
                    <button className="button is-primary">Save</button>
                </div>
            </form>
        </div>
    )
}
 
export default AddProduct