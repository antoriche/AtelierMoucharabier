<div>
    <h2>Contact</h2>
    <form method="post" enctype="multipart/form-data" >
        <table style="width: 100%;">
            <tr>
                <td>Votre email : </td>
                <td><input name="email" type='text'/></td>
            </tr>
            <tr>
                <td>Sujet : </td>
                <td><input name="subject" type='text' bold/></td>
            </tr>
        </table>
        <textarea name="message" rows="10"></textarea>
        <div>
            Pièces jointes :
            <input name="attachment" type="file" multiple="multiple"/>
        </div>
        <input type="submit" value="Envoyer"/>
    </form>
</div>
