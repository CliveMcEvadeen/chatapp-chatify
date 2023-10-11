from flask import Flask, request, jsonify

class Filter:

    app=Flask(__name__)

    @app.route('/sendToAPI', methods=['POST'])
    def get_data(self):

        data=request.get_json()
        response=data.get('text')
        # processed_data={'output':data['candidates'][0]['output']}
        respondant_data='yes the data was successfully received, thank you!'

        return jsonify(respondant_data)
    
    if __name__=="__main__":
        app.run(host = '0.0.0.0', port=8000)