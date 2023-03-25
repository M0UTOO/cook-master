import React, { useState, useEffect } from 'react';
import "./App.css"

const App = () => {
  const [data, setData] = useState(null);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState(null);

  const fetchData = async () => {
    setLoading(true);
    setError(null);

    try {
      const response = await fetch("http://localhost:8081");
      const data = await response.json();

      console.log(data)

      if (!response.ok) {
        throw new Error(`Error: ${data.message}`);
      }

      setData(data);
    } catch (error) {
      setError(error.message);
    } finally {
      setLoading(false);
    }
  };

  useEffect(() => {
    // Perform the initial query
    fetchData();
  }, []);

  return (
    <div>
      <button onClick={fetchData}>Fetch Data</button>
      {loading && <div>Loading...</div>}
      {error && <div>Error: {error}</div>}
      {data && data.message}
    </div>
  );
};

export default App;
