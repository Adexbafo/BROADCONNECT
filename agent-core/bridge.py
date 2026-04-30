from fastapi import FastAPI
import sqlite3
import pandas as pd

app = FastAPI()

@app.get("/agent/stats")
def get_stats():
    conn = sqlite3.connect('../database/database.sqlite')
    # Get Treasury
    treasury = pd.read_sql_query("SELECT SUM(amount) as total FROM bcids", conn).iloc[0]['total']
    # Get Spam Count (Simulated for log)
    spam_count = 5 # We can make this dynamic later
    return {
        "treasury": float(treasury) if treasury else 0,
        "network_health": 98.5,
        "recent_alerts": ["Spam detected on BCID-4", "New citizen minted: BCID-12"]
    }

@app.get("/agent/ask")
def ask_agent(question: str, bcid: int = 1):
    # This is where we will eventually plug in the LLM logic
    if "treasury" in question.lower():
        return {"answer": "The treasury currently holds $30.00 secured by the protocol."}
    return {"answer": "I am analyzing the protocol data. Ask me about the treasury or network health!"}