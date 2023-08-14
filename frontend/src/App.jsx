import React from 'react'
import axios from 'axios'
import { useState, useEffect } from 'react'

const App = () => {
  const [firstName, setFirstName] = useState('');
  const [lastName, setLastName] = useState('');
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");

  const data = {firstName, lastName, email, password};
  
  const submit = () => {
    console.log(data);
    const url = "http://localhost/fullstack/backend/signup.php"
    axios.post(url, data, {
      headers: {
        'Access-Control-Allow-Origin': '*',
        'Content-Type': 'application/json',
      }
    }).then((res)=>{
      console.log(res.data);
    }).catch((err)=>{
      console.log(err);
    })
  }

  return (
    <>
      <div className='mx-auto container shadow py-5 mt-5 px-5'>
        <h6 className='display-6 text-center text-muted'>Sign Up</h6>
        <input type="text" className="form-control border-dark my-3" onChange={(e)=>setFirstName(e.target.value)} />
        <input type="text" className="form-control border-dark my-3" onChange={(e)=>setLastName(e.target.value)}/>
        <input type="text" className="form-control border-dark my-3" onChange={(e)=>setEmail(e.target.value)}/>
        <input type="text" className="form-control border-dark my-3" onChange={(e)=>setPassword(e.target.value)}/>
        <button onClick={submit} className='btn btn-dark'>Sign up</button>
      </div>
    </>
  )
}

export default App