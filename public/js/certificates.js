(async function () {
    const data = await fetch('http://localhost/api/programmes'),
        progs = await data.json(),
        progIncorp = document.querySelector('.prog_incorp');

    progs.data.forEach(prog => {
        let html = `
            <input type="checkbox" class="form-check-input" name="prog_incor[]" id="prog_incorp_${prog.id}"
                    value="${prog.id}">
            <label class="form-check-label" for="prog_incorp_${prog.id}">
                    ${prog.prog_name}
            </label>
            <br />
            `;
        progIncorp.innerHTML += html;
    });
})();

(async function () {
    const data = await fetch('http://localhost/api/certificates'),
        certs = await data.json(),
        certTbody = document.querySelector('.cert_tbody');

    certs.data.forEach(cert => {
        const csrfToken = $('meta[name="csrf-token"]').attr('content');
        let html = `
            <tr>
                <td>${cert.id}</td>
                <td>${cert.cert_name}</td>
                <td>${cert.cert_desc.length > 50 ? cert.cert_desc.substring(0,50) : cert.cert_desc}</td>
                <td>
                    <a type="button" href="/faculty_staff/certificates/${cert.id}/edit" name="edit_btn" id="edit_btn"
                        class="btn btn-outline-primary btn-md btn-block">Edit</a>
                </td>
                <td>
                    <a href="#" class="btn btn-outline-danger btn-block"
                        onclick="deleteCertificate('${cert.id}', '${cert.cert_name}')">Delete</a>
                    <form method="post" action="/faculty_staff/certificates/${cert.id}/delete" id="delete${cert.id}"
                        style="display: none;">
                        <input type="hidden" name="_token" value="${csrfToken}">
                    </form>
                </td>
            </tr>
            `;
        certTbody.innerHTML += html;
    });
})();

(function () {
    setTimeout(() => {
        document.querySelector('.alert').remove();
    }, 5000);
})();