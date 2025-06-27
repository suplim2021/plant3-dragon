let billingId = document.querySelector('.aft-billing').value
let shippingId = document.querySelector('.aft-shipping').value

let billinAdress = document.querySelector(billingId)
let shippingAddress = document.querySelector(shippingId)
let textBefore = document.querySelector('.aft-text-before')
let textAfter = document.querySelector('.aft-text-after')

if (billinAdress != undefined && billingId != '') {
    let state = document.querySelector('#billing_state')
    let city = document.querySelector('#billing_city')
    let address2 = document.querySelector('#billing_address_2')
    let postcode = document.querySelector('#billing_postcode')
    let stateText = ''

    for (let index = 0; index < state.length; index++) {
        let option = state.options[index]
        if (option.value == state.value) {
            stateText = option.text
        }
    }

    let defaultText = ''
    if (address2.value != '' && city.value != '' && postcode != '') {
        defaultText = address2.value + ', ' + city.value + ', ' + stateText + ' ' + postcode.value
    }

    let p = document.createElement("p")
    let label = document.createElement("span")
    let input = document.createElement("input")
    input.setAttribute('type', 'text');

    p.classList.add('billing-address-filter')
    if (defaultText == '') {
        label.innerHTML = textAfter.value + ' <b>*</b>'
    } else {
        label.innerHTML = textBefore.value + ' <b>*</b>'
    }
    input.value = defaultText

    p.appendChild(label)
    p.appendChild(input)
    billinAdress.querySelector('.woocommerce-input-wrapper').after(p)

    input.addEventListener('focus', function (e) {
        e.target.value = ''
        label.innerHTML = textAfter.value + ' <span>*</span>'
    })

    let container = document.createElement("div")
    let ul = document.createElement("ul")

    container.classList.add('custom-address-area')
    container.appendChild(ul)
    input.after(container)

    input.addEventListener('keyup', function (e) {
        let code = e.target.value
        let file = '/wp-content/themes/plant3/assets/files/th-address.json'

        container.style.display = 'block'
        fetch(file).then((response) => response.json()).then((json) => loopJson(code, json, 'billing'))
    })

    document.addEventListener('click', function (e) {
        if (e.target.closest('.postcode-add-address')) {
            e.preventDefault()

            let addressText = e.target.innerHTML
            input.value = addressText
            label.innerHTML = textBefore.value + ' <span>*</span>'
            container.style.display = 'none'

            state.value = woocommerceStatesCodeTH(e.target.dataset.state)
            city.value = e.target.dataset.city
            address2.value = e.target.dataset.district
            postcode.value = e.target.dataset.postcode

        }
        if (!e.target.closest('.postcode-add-address') && !e.target.closest('.billing-address-filter input')) {
            if (input.value == '') {
                container.style.display = 'none'
                input.value = defaultText
                label.innerHTML = textAfter.value + ' <span>*</span>'
            }
        }
    })
}

if (shippingAddress != undefined && shippingId != '') {
    let state = document.querySelector('#shipping_state')
    let city = document.querySelector('#shipping_city')
    let address2 = document.querySelector('#shipping_address_2')
    let postcode = document.querySelector('#shipping_postcode')
    let stateText = ''

    for (let index = 0; index < state.length; index++) {
        let option = state.options[index]
        if (option.value == state.value) {
            stateText = option.text
        }
    }

    let defaultText = ''
    if (address2.value != '' && city.value != '' && postcode != '') {
        defaultText = address2.value + ', ' + city.value + ', ' + stateText + ' ' + postcode.value
    }

    let p = document.createElement("p")
    let label = document.createElement("span")
    let input = document.createElement("input")
    input.setAttribute('type', 'text');

    p.classList.add('shipping-address-filter')
    if (defaultText == '') {
        label.innerHTML = textAfter.value + ' <b>*</b>'
    } else {
        label.innerHTML = textBefore.value + ' <b>*</b>'
    }
    input.value = defaultText

    p.appendChild(label)
    p.appendChild(input)
    shippingAddress.querySelector('.woocommerce-input-wrapper').after(p)

    input.addEventListener('focus', function (e) {
        e.target.value = ''
        label.innerHTML = textAfter.value + ' <span>*</span>'
    })

    let container = document.createElement("div")
    let ul = document.createElement("ul")

    container.classList.add('custom-address-shipping')
    container.appendChild(ul)
    input.after(container)

    input.addEventListener('keyup', function (e) {
        let code = e.target.value
        let file = '/wp-content/themes/plant3/assets/files/th-address.json'

        container.style.display = 'block'
        fetch(file).then((response) => response.json()).then((json) => loopJson(code, json, 'shipping'))
    })

    document.addEventListener('click', function (e) {
        if (e.target.closest('.postcode-add-shipping')) {
            e.preventDefault()

            let addressText = e.target.innerHTML
            input.value = addressText
            label.innerHTML = textBefore.value + ' <span>*</span>'
            container.style.display = 'none'

            state.value = woocommerceStatesCodeTH(e.target.dataset.state)
            city.value = e.target.dataset.city
            address2.value = e.target.dataset.district
            postcode.value = e.target.dataset.postcode

        }
        if (!e.target.closest('.postcode-add-shipping') && !e.target.closest('.shipping-address-filter input')) {
            if (input.value == '') {
                container.style.display = 'none'
                input.value = defaultText
                label.innerHTML = textAfter.value + ' <span>*</span>'
            }
        }
    })
}

function loopJson(code, data, position) {
    let items = [];
    data.forEach(function (e) {
        if (e.zip == code) {
            const dis = e.dList;
            const prov = e.pList;
            const sub = e.sdList;
            sub.forEach(function (item) {
                const district = dis.filter((obj) => {
                    return obj.d === item.d;
                });
                const province = prov.filter((obj) => {
                    return obj.p === item.p;
                });
                const subName = item.sdName;
                const disName = district[0].dName;
                const provName = province[0].pName;
                const addressText = 'ต. ' + subName + ' อ. ' + disName + ' จ. ' + provName + ' ' + code;

                var liClass = 'postcode-add-address'
                if (position == 'shipping') {
                    liClass = 'postcode-add-shipping'
                }

                var item = '<li><a href="#" class="' + liClass + '" data-district="' + subName + '" data-city="' + disName + '" data-state="' + provName + '" data-postcode="' + code + '">' + addressText + '</a></li>';
                items.push(item);
            });
        }
    });

    var addressArea = document.querySelector('.custom-address-area ul')
    if (position == 'shipping') {
        addressArea = document.querySelector('.custom-address-shipping ul')
    }

    if (items.length > 0) {
        addressArea.innerHTML = '';
        items.forEach(function (item) {
            addressArea.innerHTML += item;
        });
    } else {
        if (code.length >= 5) {
            addressArea.innerHTML = '<p>* รหัสไปรษณีย์ไม่ถูกต้อง</p>';
        } else {
            addressArea.innerHTML = '';
        }
    }
}

function woocommerceStatesCodeTH(name) {
    var states = {
        'กระบี่': "TH-81",
        'กรุงเทพมหานคร': "TH-10",
        'กาญจนบุรี': "TH-71",
        'กาฬสินธุ์': "TH-46",
        'กำแพงเพชร': "TH-62",
        'ขอนแก่น': "TH-40",
        'จันทบุรี': "TH-22",
        'ฉะเชิงเทรา': "TH-24",
        'ชลบุรี': "TH-20",
        'ชัยนาท': "TH-18",
        'ชัยภูมิ': "TH-36",
        'ชุมพร': "TH-86",
        'เชียงราย': "TH-57",
        'เชียงใหม่': "TH-50",
        'ตรัง': "TH-92",
        'ตราด': "TH-23",
        'ตาก': "TH-63",
        'นครนายก': "TH-26",
        'นครปฐม': "TH-73",
        'นครพนม': "TH-48",
        'นครราชสีมา': "TH-30",
        'นครศรีธรรมราช': "TH-80",
        'นครสวรรค์': "TH-60",
        'นนทบุรี': "TH-12",
        'นราธิวาส': "TH-96",
        'น่าน': "TH-55",
        'บึงกาฬ': "TH-38",
        'บุรีรัมย์': "TH-31",
        'ปทุมธานี': "TH-13",
        'ประจวบคีรีขันธ์': "TH-77",
        'ปราจีนบุรี': "TH-25",
        'ปัตตานี': "TH-94",
        'พระนครศรีอยุธยา': "TH-14",
        'พะเยา': "TH-56",
        'พังงา': "TH-82",
        'พัทลุง': "TH-93",
        'พิจิตร': "TH-66",
        'พิษณุโลก': "TH-65",
        'เพชรบุรี': "TH-76",
        'เพชรบูรณ์': "TH-67",
        'แพร่': "TH-54",
        'ภูเก็ต': "TH-83",
        'มหาสารคาม': "TH-44",
        'มุกดาหาร': "TH-49",
        'แม่ฮ่องสอน': "TH-58",
        'ยโสธร': "TH-35",
        'ยะลา': "TH-95",
        'ร้อยเอ็ด': "TH-45",
        'ระนอง': "TH-85",
        'ระยอง': "TH-21",
        'ราชบุรี': "TH-70",
        'ลพบุรี': "TH-16",
        'ลำปาง': "TH-52",
        'ลำพูน': "TH-51",
        'เลย': "TH-42",
        'ศรีสะเกษ': "TH-33",
        'สกลนคร': "TH-47",
        'สงขลา': "TH-90",
        'สตูล': "TH-91",
        'สมุทรปราการ': "TH-11",
        'สมุทรสงคราม': "TH-75",
        'สมุทรสาคร': "TH-74",
        'สระแก้ว': "TH-27",
        'สระบุรี': "TH-19",
        'สิงห์บุรี': "TH-17",
        'สุโขทัย': "TH-64",
        'สุพรรณบุรี': "TH-72",
        'สุราษฎร์ธานี': "TH-84",
        'สุรินทร์': "TH-32",
        'หนองคาย': "TH-43",
        'หนองบัวลำภู': "TH-39",
        'อ่างทอง': "TH-15",
        'อำนาจเจริญ': "TH-37",
        'อุดรธานี': "TH-41",
        'อุตรดิตถ์': "TH-53",
        'อุทัยธานี': "TH-61",
        'อุบลราชธานี': "TH-34",
    }
    return states[name]
}