$(".tab-wizard").steps({
	headerTag: "h5",
	bodyTag: "section",
	transitionEffect: "fade",
	titleTemplate: '<span class="step">#index#</span> #title#',
	labels: {
		finish: "Submit"
	},
	onStepChanged: function (event, currentIndex, priorIndex) {
		$('.steps .current').prevAll().addClass('disabled');
	},
	onFinished: function (event, currentIndex) {
		$('#success-modal').modal('show');
	}
});

$(".tab-wizard2").steps({
	headerTag: "h5",
	bodyTag: "section",
	transitionEffect: "fade",
	titleTemplate: '<span class="step">#index#</span> <span class="info">#title#</span>',
	labels: {
		finish: "Submit",
		next: "Next",
		previous: "Previous",
	},
	onStepChanged: function(event, currentIndex, priorIndex) {
		$('.steps .current').prevAll().addClass('disabled');
	},
	onFinished: function(event, currentIndex) {
		$('#success-modal-btn').trigger('click');
	}
});

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Simpan data dari setiap langkah
        let formData = {};

        // Tambahkan event listener untuk tombol "Next"
        document.getElementById("submit-button").addEventListener("click", function () {
            // Kumpulkan data dari langkah Personal Info
            formData.first_name = document.getElementById("first_name").value;
            formData.last_name = document.getElementById("last_name").value;
            formData.email = document.getElementById("email").value;
            formData.phone_number = document.getElementById("phone_number").value;
            formData.city = document.getElementById("city").value;
            formData.date_of_birth = document.getElementById("date_of_birth").value;

            // Kumpulkan data dari langkah Job Status
            formData.job_title = document.getElementById("job_title").value;
            formData.company_name = document.getElementById("company_name").value;
            formData.job_description = document.getElementById("job_description").value;

            // Kumpulkan data dari langkah Interview
            formData.interview_for = document.getElementById("interview_for").value;
            formData.interview_type = document.getElementById("interview_type").value;
            formData.interview_date = document.getElementById("interview_date").value;
            formData.interview_time = document.getElementById("interview_time").value;

            // Kumpulkan data dari langkah Remark
            formData.behaviour = document.getElementById("behaviour").value;
            formData.confidance = document.getElementById("confidance").value;
            formData.result = document.getElementById("result").value;
            formData.comments = document.getElementById("comments").value;

            // Kirim data ke server menggunakan AJAX atau cara lainnya
            // Misalnya, Anda dapat menggunakan fetch API untuk mengirim data ke server.
            fetch('URL_SERVER_ANDA', {
                method: 'POST',
                body: JSON.stringify(formData),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                // Data berhasil dikirim, lakukan tindakan lanjutan seperti menampilkan pesan sukses atau mengarahkan pengguna ke halaman lain.
                console.log('Response dari server:', data);
                alert('Form berhasil disubmit!');
            })
            .catch(error => {
                // Terjadi kesalahan saat mengirim data ke server, tampilkan pesan kesalahan atau lakukan tindakan lain sesuai kebutuhan.
                console.error('Terjadi kesalahan:', error);
                alert('Terjadi kesalahan saat mengirim data.');
            });
        });
    });
</script>
