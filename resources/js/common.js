
document.addEventListener('DOMContentLoaded', function() {

    /**
    * 게시판관리(board)
    */

    // 게시판관리 - 삭제버튼
	let boardDeleteBtn = document.querySelectorAll('.btnDelete');

    // checkbox 이벤트 등록
    boardDeleteBtn.forEach((elem, key) => {
        elem.addEventListener("click", function () {

            // data-name 속성 추출
            const itemValue = elem.dataset.name;

            // checking
            if (!itemValue) {
                alert("잘못된 접근입니다");
                return;
            }

            if (!confirm("삭제하시겠습니까?")) return;

            document.getElementById("deleteFrm-" + itemValue).submit();

        });

    });

});

