from flask import Flask, request, jsonify

class Filter:

    app=Flask(__name__)

    @app.route('/processdata', methods=['POST'])
    def get_data(self):

        data=request.json
        processed_data={'output':data['candidates'][0]['output']}

        return jsonify(processed_data)
    
    if __name__=="__main__":
        app.run(host = '0.0.0.0', port=8000)