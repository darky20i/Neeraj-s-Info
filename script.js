let currentType = "";

function selectType(type){
  currentType = type;
  document.getElementById("input").placeholder =
    "Enter " + type + " number";
}

function safe(val){
  if(val === undefined || val === null || val === "" || val === "NA"){
    return "Not Available";
  }
  return val;
}

function check(){
  const value = document.getElementById("input").value;
  const result = document.getElementById("result");

  if(!value){
    result.innerHTML = "❌ Please enter a value";
    return;
  }

  result.innerHTML = "⏳ Fetching data...";

  fetch("api.php",{
    method:"POST",
    headers:{ "Content-Type":"application/json" },
    body:JSON.stringify({
      type: currentType,
      value: value
    })
  })
  .then(res => res.json())
  .then(d => {

    if(!d.api_response){
      result.innerHTML = "⚠ No data received";
      return;
    }

    // 🔥 REAL DATA LOCATION
    const raw = d.api_response.result || d.api_response;
    const data = raw["0"] || raw;

    const name     = data.name;
    const address  = data.address;
    const location = data.circle || data.state || data.region;
    const village  = data.village || data.locality || data.area;

    let html = `
      ✅ <b>Verified</b><br>
      🔐 <b>Type:</b> ${currentType}<br>
      📌 <b>Input:</b> ${value}<br><br>

      👤 <b>Name:</b> ${safe(name)}<br>
      🏠 <b>Address:</b> ${safe(address)}<br>
      📍 <b>Location:</b> ${safe(location)}<br>
      🌾 <b>Village:</b> ${safe(village)}<br>

      <hr>
      <b>🔎 Raw API Data:</b><br>
    `;

    // show raw for demo
    for (let k in data) {
      html += `📄 <b>${k}:</b> ${data[k]}<br>`;
    }

    result.innerHTML = html;
  })
  .catch(()=>{
    result.innerHTML = "❌ API / Server error";
  });
}
